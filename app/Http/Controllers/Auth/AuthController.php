<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\ConUserRegion;
use App\ConUserService;
use App\ConUserLanguage;
use App\UserTranslation;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/ads';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){
        if ($data['user_type'] != 2){ unset($data['cl_languages']); } // ТЪРСЕЩ 
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'username' => 'required|max:255',
            'name' => 'required|max:255',
            'phone' => 'required|max:45',
            'cl_organization_type_id' => 'required',
            'cl_languages' => 'required_if:user_type,2',
            'description.*' => 'required_with:cl_languages.*',
            'agreement' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user_data=array( // Общи полета за ТЪРСЕЩ и ПРЕДЛАГАЩ
            'user_type' => $data['user_type'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'username' => $data['username'],
            'phone' => $data['phone'],
            'cl_organization_type_id' => $data['cl_organization_type_id'],
            'reg_number' => $data['reg_number'],
            'vat_number' => $data['vat_number'],
        );
        $new_user = User::create($user_data);
        $translation = $new_user->getNewTranslation(\Session::get('language'));
        $translation->user_id = $new_user->id;
        $translation->name = $data['name'];
        $translation->org_name = $data['org_name'];
        $translation->address = $data['address'];
        if ($new_user->user_type == 2){
            $translation->description = $data['description'][\Session::get('language')];
        }
        $translation->save();
        
        if ($new_user->user_type == 2){ // Полета само за ПРЕДЛАГАЩ
            if (isset($data['cl_languages'])){
                $user_languages = array();
                foreach ($data['cl_languages'] as $language_code => $language){
                    $user_languages[] = array(
                        'user_id'=>$new_user->id,
                        'cl_language_id'=>$language
                    );
                    if ($language_code != \Session::get('language')){
                        $translation = $new_user->getNewTranslation($language_code);
                        $translation->user_id = $new_user->id;
                        $translation->description = $data['description'][$language_code];
                        $translation->save();
                    }
                }
                ConUserLanguage::insert($user_languages);
            }
            if (isset($data['regions'])){
                $user_regions = array();
                foreach ($data['regions'] as $region){
                    $user_regions[] = array(
                        'user_id'=>$new_user->id,
                        'cl_region_id'=>$region
                    );
                }
                ConUserRegion::insert($user_regions);
            }
            if (isset($data['services'])){
                $user_services = array();
                foreach ($data['services'] as $key => $service){
                    $user_services[] = array(
                        'user_id'=>$new_user->id,
                        'cl_service_id'=>$service,
                        'min_budget'=>$data['budget'][$key]
                    );
                }
                ConUserService::insert($user_services);
            }
        }
        return $new_user;
    }

}
