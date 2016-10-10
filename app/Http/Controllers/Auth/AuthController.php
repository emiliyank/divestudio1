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
    protected $redirectTo = '/';

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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|max:45',
            'password' => 'required|min:6|confirmed',
            'user_type' => 'required',
            'description' => 'max:1000',
            'cl_organization_type_id' => 'required',
            'reg_number' => 'max:90',
            'is_receiving_emails' => 'required',
            'cl_languages' => 'required',
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
        $user_data=array(
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'user_type' => $data['user_type'],
            'description' => $data['description'],
            'cl_organization_type_id' => $data['cl_organization_type_id'],
            'org_name' => $data['org_name'],
            'is_receiving_emails' => $data['is_receiving_emails'],
        );
        if ($data['cl_organization_type_id'] > 1){
            $user_data['reg_number'] = $data['reg_number'];
        }
        $new_user = User::create($user_data);
        if ($new_user->id){
            if (isset($data['cl_languages'])){
                $user_languages = array();
                foreach ($data['cl_languages'] as $language){
                    $user_languages[] = array(
                        'user_id'=>$new_user->id,
                        'cl_language_id'=>$language
                    );
                }
                ConUserLanguage::insert($user_languages);
            }
            if (isset($data['regions']) && $data['user_type'] == 2){
                $user_regions = array();
                foreach ($data['regions'] as $region){
                    $user_regions[] = array(
                        'user_id'=>$new_user->id,
                        'cl_region_id'=>$region
                    );
                }
                ConUserRegion::insert($user_regions);
            }
            if (isset($data['services']) && $data['user_type'] == 2){
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
