<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\ActivationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

use Session;
use Config;
use Validator;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\UserTranslation;
use App\ConUserService;
use App\ConUserRegion;
use App\ConUserLanguage;
use App\ConRoleAccess;
use App\ConUserAccess;
use App\ClService;
use App\ClRegion;
use App\ClLanguage;
use App\ClOrganizationType;
use App\ClAccess;
use App\CmAd;
use App\CmMessage;
use App\CmRating;
use App\ClRole;
use App\SystemSetting;

class UserController extends Controller
{
    protected $activationService;

    protected $activationRepo;

    protected $mailer;

	public function __construct(ActivationService $activationService, App\ActivationRepository $activationRepo, Mailer $mailer)
    {
        $this->middleware('auth');
        $this->activationService = $activationService;
        $this->activationRepo = $activationRepo;
        $this->mailer = $mailer;
    }

    public function user_profile()
    {
        $user_id = \Auth::id();
        $user = User::with('userType')
        ->with(['cmRatings' => function ($query){
                $query->where('user_graded_id', \Auth::id());
            }])
        ->where('id', $user_id)->first();
        $user_accesses = ConRoleAccess::with(array('clRoles', 'clAccesses'))
            ->where('cl_role_id', $user->user_type)->get();
        $admin_accesses = array();
        if(\Session::get('user_type') == \Config::get('constants.USER_ROLE_ADMIN'))
        {
            $admin_accesses = ConUserAccess::with('clAccesses')
                ->where('user_id', $user->id)->get();
        }

        return view ('users.profile', [
            'user' => $user,
            'user_accesses' => $user_accesses,
            'admin_accesses' => $admin_accesses,
            ]);
    }

    public function show_user_profile($user_id)
    {
        $user = User::with('userType')
        ->with(['cmRatings' => function ($query) use($user_id){
                $query->where('user_graded_id', $user_id);
            }])
        ->where('id', $user_id)->first();
        $user_accesses = ConRoleAccess::with(array('clRoles', 'clAccesses'))
            ->where('cl_role_id', $user->user_type)->get();

        return view ('users.view_profile', [
            'user' => $user,
            'user_accesses' => $user_accesses,
            ]);
    }

    public function edit_account_info_form()
    {
        $user_id = \Auth::id();
        $user = User::where('id', $user_id)->first();
        $cl_organization_types = ClOrganizationType::get();

        return view ('users.edit_account', [
            'user' => $user,
            'cl_organization_types' => $cl_organization_types,
            ]);
    }

    public function edit_account_submit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'new_password' => 'min:6',
            'new_password_confirmation' => 'min:6|same:new_password',
            ]);

        $user_id = \Auth::id();
        $user = User::where('id', $user_id)->first();
        $user->cl_organization_type_id = $request->cl_organization_type_id;
        $user->phone = $request->phone;
        $user->reg_number = $request->reg_number;
        $user->vat_number = $request->vat_number;
        $user->is_receiving_emails = $request->is_receiving_emails;

        $user_translation = $user->translateOrNew(\Session::get('language'));
        $user_translation->user_id = $user_id;
        $user_translation->name = $request->name;
        $user_translation->org_name = $request->org_name;
        $user_translation->address = $request->address;
        $user_translation->save();

        if( ! empty($request->new_password))
        {
            if(Hash::check($request->old_password, $user->password))
            {
                $user->password = Hash::make($request->new_password);
                Session::flash('password_changed', trans('common.password_changed_success'));
            }else{
               Session::flash('password_changed', trans('common.old_pass_not_match')); 
            }
        }
        $user->save();

        Session::flash('updated_data', trans('common.flash_update_success'));
        return redirect('/account');
    }

    public function edit_user_details_form()
    {
       $user_id = \Auth::id();
       $user = User::where('id', $user_id)->first();
       $user_services_data = $user->conUserServices()->get();
       $user_services = [];
       foreach ($user_services_data as $user_service) {
          $user_services[$user_service->cl_service_id] = $user_service->min_budget;
      }

      $user_regions_data = $user->conUserRegions()->get();
      $user_regions = [];
      foreach ($user_regions_data as $user_region) {
          $user_regions[$user_region->cl_region_id] = $user_region->cl_region_id;
      }

      $user_languages_data = $user->conUserLanguages()->get();
      $user_languages = [];
      foreach ($user_languages_data as $user_language) {
          $user_languages[$user_language->cl_language_id] = $user_language->cl_language_id;
      }

      $cl_services = ClService::get();
      $cl_regions = ClRegion::get();
      $cl_languages = ClLanguage::get();

      return view ('users.edit_details', [
          'user' => $user,
          'cl_services' => $cl_services,
          'cl_regions' => $cl_regions,
          'cl_languages' => $cl_languages,

          'user_services' => $user_services,
          'user_regions' => $user_regions,
          'user_languages' => $user_languages,
          ]);
  }

  public function edit_user_details_submit(Request $request)
  {
    $this->validate($request, [
        'description_bg' => 'required',
        ]);

    $user = User::where('id', \Auth::id())->first();
    $translation_bg = $user->translateOrNew(\Config::get('constants.LANGUAGE_BG'));
    $translation_bg->user_id = \Auth::id();
    $translation_bg->description = $request->description_bg;
    $translation_bg->save();

    if($request->description_en)
    {
        $lang_en = \Config::get('constants.LANGUAGE_EN');
        $translation_en = $user->translateOrNew($lang_en);
        $translation_en->user_id = \Auth::id();
        $translation_en->description = $request->description_en;
        $translation_en->save();
    }


        //merge the old and new services
    $user_services_data = $user->conUserServices()->get();
    $user_services = [];
    foreach ($user_services_data as $user_service) {
        $user_services[$user_service->cl_service_id] = $user_service->min_budget;
    }

    if( ! empty ($request->services))
    {
        foreach($request->services as $new_service_id)
        {
            if( ! empty ($user_services[$new_service_id]))
            {
                    //the item was already in the DB
                if($user_services[$new_service_id] != $request->min_budget[$new_service_id])
                {
                    $con_user_service = ConUserService::where('user_id', \Auth::id())->where('cl_service_id', $new_service_id)->first();
                    $con_user_service->min_budget = $request->min_budget[$new_service_id];
                    $con_user_service->save();
                }
                
                unset($user_services[$new_service_id]);
            }else{
                    //selected new\ item => insert into DB
                $con_user_service = new ConUserService();
                $con_user_service->user_id = \Auth::id();
                $con_user_service->cl_service_id = $new_service_id;
                if( ! empty($request->min_budget[$new_service_id]))
                {
                    $con_user_service->min_budget = $request->min_budget[$new_service_id];    
                }
                $con_user_service->save();
            }
        }   
    }

    if( ! empty ($user_services))
    {
        foreach($user_services as $old_service_id => $old_service_budget)
        {
                    //old services that were not submitet => must be removed from DB
            $old_user_service = ConUserService::where('user_id', \Auth::id())->where('cl_service_id', $old_service_id)->first();
            $old_user_service->delete();
        }
    }


        //merge the old and new regions
    $user_regioins_data = $user->conUserRegions()->get();
    $user_regions = [];
    foreach ($user_regioins_data as $user_region) {
        $user_regions[$user_region->cl_region_id] = $user_region->cl_region_id;
    }

    if( ! empty ($request->regions))
    {
        foreach($request->regions as $new_region_id)
        {
            if( ! empty ($user_regions[$new_region_id]))
            {
                    //the item was already in the DB
                unset($user_regions[$new_region_id]);
            }else{
                    //selected new item => insert into DB
                $con_user_region = new ConUserRegion();
                $con_user_region->user_id = \Auth::id();
                $con_user_region->cl_region_id = $new_region_id;
                $con_user_region->save();
            }
        }   
    }

    if( ! empty ($user_regions))
    {
        foreach($user_regions as $old_region_id)
        {
            //old regions that were not submited => must be removed from DB
            $old_user_region = ConUserRegion::where('user_id', \Auth::id())->where('cl_region_id', $old_region_id)->first();
            $old_user_region->delete();
        }
    }


    $user_languages_data = $user->conUserLanguages()->get();
    $user_languages = [];
    foreach ($user_languages_data as $user_language) {
        $user_languages[$user_language->cl_language_id] = $user_language->cl_language_id;
    }
    if( ! empty ($request->languages))
    {
        foreach($request->languages as $new_language_id)
        {
            if( ! empty ($user_languages[$new_language_id]))
            {
                    //the item was already in the DB
                unset($user_languages[$new_language_id]);
            }else{
                    //selected new item => insert into DB
                $con_user_language = new ConUserLanguage();
                $con_user_language->user_id = \Auth::id();
                $con_user_language->cl_language_id = $new_language_id;
                $con_user_language->save();
            }
        }   
    }
    if( ! empty ($user_languages))
    {
        foreach($user_languages as $old_language_id)
        {
            //old languages that were not submited => must be removed from DB
            $old_user_language = ConUserLanguage::where('user_id', \Auth::id())->where('cl_language_id', $old_language_id)->first();
            $old_user_language->delete();
        }
    }

        Session::flash('updated_data', trans('common.flash_update_success'));
        return redirect("/user-details");
    }

    public function ads_list(){
        $user=User::where('id', \Auth::id())->first();
        if ($user->user_type == 2 || $user->user_type == 999){ 
        // Предлагащ услуги ==================================================================
            $unanswered=array();
            $answered=array();
//            $cl_services = ClService::get();
//            $cl_regions = ClRegion::get();
            $cl_languages = ClLanguage::get();
            $languages = [];
            foreach ($cl_languages as $language){
                $languages[$language->language] = $language->locale_code;
            }
            //==================================================================
            $user_services_data = $user->conUserServices()->get();
            $user_services = [];
            foreach ($user_services_data as $user_service) {
                $user_services[$user_service->cl_service_id] = $user_service->min_budget;
            }
            $user_regions_data = $user->conUserRegions()->get();
            $user_regions = [];
            foreach ($user_regions_data as $user_region) {
                $user_regions[$user_region->cl_region_id] = $user_region->cl_region_id;
            }
            $user_languages_data = $user->conUserLanguages()->get();
            $user_languages = [];
            foreach ($user_languages_data as $user_language) {
                $user_languages[$languages[$user_language->cl_language_id]] = $user_language->cl_language_id;
            }
            //==================================================================
            $all_ads = CmAd::with(array('createdBy','clRegions','clService'))
                    ->whereNull('date_accepted')
                    ->whereNull('date_deleted')
                    ->where([['created_by', '<>', \Auth::id()],
                             ['deadline','>=',date('Y-m-d').' 00:00:00']])
                    ->whereIn('service_id', array_keys($user_services))
                    ->orderBy('cm_ads.id', 'desc')
                    ->get();
            //==================================================================
            foreach ($all_ads as $ad){
                $ad_regions = array();
                foreach($ad->clRegions as $region){
                    $ad_regions[] = $region['id'];
                }
                $ad_locale = $ad->getTranslation()['locale'];
                if (isset($user_languages[$ad_locale]) &&
                    $ad->budget >= $user_services[$ad->service_id] && 
                    array_intersect($user_regions,$ad_regions)){
                    $unanswered[] = $ad;
                }
            }
            //==================================================================
            return view ('ads.ads_list', [
                'unanswered' => $unanswered,
                'answered' => $answered,
                'count_all_regions' => ClRegion::get()->count(),
            ]);
        }
    }

    public function ads_list_ver(){
        $user_id = \Auth::id();
        $user = User::where('id', $user_id)->first();
        if ($user->user_type == 2 || $user->user_type == 999){ // Предлагащ услуги
            $user_services_data = $user->conUserServices()->get();
            $user_services = [];
            foreach ($user_services_data as $user_service) {
                $user_services[$user_service->cl_service_id] = $user_service->min_budget;
            }
            $user_regions_data = $user->conUserRegions()->get();
            $user_regions = [];
            foreach ($user_regions_data as $user_region) {
                $user_regions[$user_region->cl_region_id] = $user_region->cl_region_id;
            }
            $cl_languages = ClLanguage::get();
            $languages = [];
            foreach ($cl_languages as $language){
                $languages[$language->language] = $language->locale_code;
            }
            $user_languages_data = $user->conUserLanguages()->get();
            $user_languages = [];
            foreach ($user_languages_data as $user_language) {
                $user_languages[$languages[$user_language->cl_language_id]] = $user_language->cl_language_id;
            }
//            $cl_services = ClService::get();
//            $cl_regions = ClRegion::get();
            $all_ads = CmAd::with(array('createdBy','clRegions'))
                    ->whereNull('date_accepted')
                    ->whereNull('date_deleted')
                    ->where([
                                ['created_by', '<>', \Auth::id()],
                                ['deadline','>=',date('Y-m-d').' 00:00:00']])
                    ->whereIn('service_id', array_keys($user_services))
                    //->whereIn('locale', array_keys($user_languages))
                    ->orderBy('cm_ads.id', 'desc')
                    ->get();
            $unanswered = array();
            $answered = array();
            foreach ($all_ads as $ad){
                $ad_regions = array();
                foreach($ad->clRegions as $region){
                    $ad_regions[] = $region['id'];
                }
                if ($ad->budget >= $user_services[$ad->service_id] && 
                        array_intersect($user_regions,$ad_regions)
                ){
                    if($ad->hasTranslation('bg')){
                        $unanswered[$ad->id]['title'] = $ad->getTranslation('bg')->title;
                    }
                    else{
                        $unanswered[$ad->id]['title'] = $ad->getTranslation('en')->title;
                    }
                    if ($ad->createdBy->getTranslation(\Session::get('language'))->org_name){
                        $unanswered[$ad->id]['from'] = $ad->createdBy->getTranslation(\Session::get('language'))->org_name.' - '.
                                                       $ad->createdBy->getTranslation(\Session::get('language'))->name;
                    }
                    else{
                        $unanswered[$ad->id]['from'] = $ad->createdBy->getTranslation(\Session::get('language'))->name;
                    }
                    $unanswered[$ad->id]['budget'] = $ad->budget;
                    $unanswered[$ad->id]['deadline'] = date('d.m.Y',strtotime($ad->deadline));
                }
            }

            return view ('ads.ads_list_ver', [
                'unanswered' => $unanswered,
                'answered' => $answered,
            ]);
//            echo "<pre>";
//            print_r($user);
//            echo "=============<br/>";
//            print_r($user_services);
//            echo "=============<br/>";
//            print_r($user_regions);
//            echo "=============<br/>";
//            print_r($user_languages);
// //            echo implode(',',array_keys($user_languages));
//            echo "=============<br/>";
//            print_r($all_ads);
//            echo "=====================================================<br/>";
//            print_r($unanswered);
//            echo "</pre>";
        }else{
            echo "За да имате получени обяви трябва да сте регистриран като потребител Предлагащ услуги, а вие не сте. 
            Нямате получени обяви!";
        }
    }

    public function admin_settings_form()
    {
        $system_settings = SystemSetting::first();
        
        return view ('users.admin_settings', [
            'system_settings' => $system_settings,
            ]);
    }

    public function admin_settings_submit(Request $request)
    {
        $this->validate($request, [
            'default_ad_days_deadline' => 'required|numeric',
        ]);

        $system_settings = SystemSetting::first();
        $system_settings->default_ad_days_deadline = $request->default_ad_days_deadline;
        $system_settings->rating_period = $request->rating_period;
        $system_settings->updated_by = \Auth::id();
        $system_settings->save();
        
        Session::flash('updated_data', trans('common.flash_update_success'));
        return redirect("/admin-settings");
    }

    public function list_all_users()
    {
        $all_users = User::with('userType')->whereNull('deleted_at')->get();
        $cl_roles = ClRole::all();

        return view ('users.list_all_users', [
            'all_users' => $all_users,
            'cl_roles' => $cl_roles,
            ]);
    }

    public function delete_user(Request $request)
    {
        $dt = new \DateTime();
        $now = $dt->format('Y-m-d H:i:s');

        $user = User::where('id', $request->user_id)->first();
        $user->deleted_at = $now;
        $user->deleted_by = \Auth::id();
        $user->save();

        Session::flash('deleted_user', trans('common.flash_deleted_user'));
        return redirect("/list-users");
    }

    public function add_admin_user_form()
    {
        return view('users.add_admin', [

            ]);
    }

    public function add_admin_user_submit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'name' => 'required',
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->user_type =  \Config::get('constants.USER_ROLE_ADMIN');
        $password = str_random(8);
        $user->password = bcrypt($password);
        $user->save();

        $user_translation = $user->translateOrNew(\Session::get('language'));
        $user_translation->user_id = $user->id;
        $user_translation->name = $request->name;
        $user_translation->save();

        $token = $this->activationRepo->createActivation($user);
        $link = route('user.activate', $token);
        $message = sprintf("
            Моля активирайте акаунта си \r\n  
            потребителско име: $user->email \r\n  парола: $password \r\n<a href='%s'>%s</a>\r\n\r\n 
            Please, activate account with \r\n  
            username: $user->email\r\n  password: $password \r\n<a href='%s'>%s</a>", 
            $link, $link, $link, $link
            );

        $this->mailer->raw($message, function (Message $m) use ($user) {
            $m->to($user->email)->subject('Счетоводство.com - Активиране на акаунт / Activation mail');
        });

        Session::flash('created_user', trans('common.flash_created_user'));
        return redirect("/list-users");
    }

    public function admin_statistics()
    {
        $contracts_made = CmAd::with('createdBy')->whereNotNull('date_accepted')->get();
        $now = date('Y-m-d H:i:s');
        $active_ads = CmAd::with('createdBy')
            ->whereNull('date_accepted')
            ->where('deadline', '>', $now)
            ->whereNull('deleted_by')
            ->get();

        $offers_on_active_ads = array();
        $offers_count = 0;
        $i = 0;
        foreach ($active_ads as $cm_ad) {
            if(count($cm_ad->cmOffers()->get()) > 0)
            {
                $offers_on_active_ads[$i] = $cm_ad->cmOffers()->get();
                $offers_count += count($offers_on_active_ads[$i]);
                $i++;
            }
        }

        $all_messages = CmMessage::all();
        $user_ratings = CmRating::all();

        return view('users.admin_statistics', [
            'contracts_made' => $contracts_made,
            'active_ads' => $active_ads,
            'offers_on_active_ads' => $offers_on_active_ads,
            'offers_count' => $offers_count,
            'all_messages' => $all_messages,
            'user_ratings' => $user_ratings,
        ]);
    }

    public function edit_user_accesses_form(User $user)
    {
        $user_data = User::with(['conUserAccesses', 'conUserAccesses.clAccesses'])->where('id', $user->id)->first();
        $all_accesses = ClAccess::where('is_admin_access', 1)->get();

        $user_access_ids = array();
        if(count($user_data->conUserAccesses) > 0)
        {
            foreach ($user_data->conUserAccesses as $access) 
            {
                $user_access_ids[] = $access->clAccesses->id;
            }
        }
        
        return view('users.edit_user_access', [
            'user_id' => $user_data->id,
            'user_email' => $user_data->email,
            'user_access_ids' => $user_access_ids,
            'all_accesses' => $all_accesses,
        ]);
    }

    public function edit_user_accesses_submit(Request $request)
    {
        $user_data = User::with(['conUserAccesses', 'conUserAccesses.clAccesses'])->where('id', $request->user_id)->first();
        $user_access_ids = array();
        if(count($user_data->conUserAccesses) > 0)
        {
            foreach ($user_data->conUserAccesses as $access) 
            {
                $user_access_ids[$access->clAccesses->id] = $access->clAccesses->id;
            }
        }

        foreach ($request->cl_access_id as $cl_access_id) 
        {
            if(in_array($cl_access_id, $user_access_ids))
            {
                //item was already in DB
                unset($user_access_ids[$cl_access_id]);
            }
            else
            {
                //new item selected => insert intro DB
                $con_user_access = new ConUserAccess();
                $con_user_access->user_id = $request->user_id;
                $con_user_access->cl_access_id = $cl_access_id;
                $con_user_access->save();
            }
        }

        if( ! empty($user_access_ids) > 0)
        {
            ConUserAccess::where('user_id', $request->user_id)
                ->whereIn('cl_access_id', $user_access_ids)->delete();
        }

        Session::flash('updated_user_access', trans('users.updated_user_access'));
        return redirect("/edit-user-access/$request->user_id");
    }
}