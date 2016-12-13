<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

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
use App\ClService;
use App\ClRegion;
use App\ClLanguage;
use App\ClOrganizationType;
use App\CmAd;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
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
            'phone' => 'required',
            'cl_organization_type_id' => 'required',
            'new_password' => 'min:6',
            'new_password_confirmation' => 'min:6|same:new_password',
            ]);

        $user_id = \Auth::id();
        $user = User::where('id', $user_id)->first();
        $user->cl_organization_type_id = $request->cl_organization_type_id;
        $user->phone = $request->phone;
        $user->reg_number = $request->reg_number;
        $user->vat_number = $request->vat_number;
        

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

    $user = User::where('id', $request->user_id)->first();

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
                unset($user_services[$new_service_id]);
            }else{
                    //selected new\ teim => insert into DB
                $con_user_service = new ConUserService();
                $con_user_service->user_id = \Auth::id();
                $con_user_service->cl_service_id = $new_service_id;
                $con_user_service->min_budget = $request->min_budget[$new_service_id];
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
        $user_id = \Auth::id();
        $user = User::where('id', $user_id)->first();
        if ($user->user_type == 2){ // Предлагащ услуги
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
            return view ('ads.ads_list', [
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
////            echo implode(',',array_keys($user_languages));
//            echo "=============<br/>";
//            print_r($all_ads);
//            echo "=====================================================<br/>";
//            print_r($unanswered);
//            echo "</pre>";
        }
    }
}