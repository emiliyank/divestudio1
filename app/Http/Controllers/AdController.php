<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use App\CmAd;
use App\CmOffer;
use App\CmRating;
use App\ClRegion;
use App\ClService;
use App\ClLanguage;
use App\ClOrganizationType;
use App\ConAdRegion;
use App\SystemSetting;
use App\User;

class AdController extends Controller
{
    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->middleware('auth');
        $this->mailer = $mailer;
    }

    public function index()
    {    
        $ads = CmAd::with(array('clRegions', 'clService', 'createdBy', 'cmOffers'))->where('created_by', \Auth::id())->get();
        
        return view('ads.user_ads', [
            'ads' => $ads,
        ]);
    }

    public function add_form(){

        $regions_data = ClRegion::orderBy('region_order', 'desc')->get();
        $services_data = ClService::get();
        $system_settings = SystemSetting::first();

        $dt = new \DateTime();
        date_add($dt, date_interval_create_from_date_string("$system_settings->default_ad_days_deadline days"));
        $default_ad_deadline = $dt->format('d-m-Y');

        return view('ads.add_ad', [
            'cl_regions' => $regions_data,
            'cl_services' => $services_data,
            'default_ad_deadline' => $default_ad_deadline,
        ]);
    }

    public function add_submit(Request $request){
        $this->validate($request, [
            'title' => 'required|max:200',
            'service_id' => 'required',
            'regions' => 'required',
            'content' => 'required|max:2000',
            'deadline' => 'required|date_format:d-m-Y',
            'budget' => 'required|integer|min:1',
	   ]);
        
        $ad = new CmAd;
        $ad->created_by = \Auth::id();
        $ad->service_id = $request->service_id;
        $ad->deadline = date('Y-m-d',strtotime($request->deadline));
        $ad->budget = $request->budget;
        $ad->save();
        $ad_id = $ad->id;

        $translation = $ad->getNewTranslation(\Session::get('language'));
        $translation->cm_ad_id = $ad_id;
        $translation->title = $request->title;
        $translation->content = $request->content;
        $translation->save();

        $regions_list = array();
        foreach ($request->regions as $region) {
            $regions_list[] = (int)$region;
            $con_ad_region = new ConAdRegion;
            $con_ad_region->cm_ad_id = $ad_id;
            $con_ad_region->cl_region_id = $region;
            $con_ad_region->save();
        }

        $this->send_emails_to_suppliers($regions_list, $request->service_id, $request->budget, $ad_id);   
        return redirect('/ads');
    }

    protected function send_emails_to_suppliers($regions_list, $service_id, $budget, $ad_id)
    {
        $users_for_email = User::
            with(['conUserServices' => function($query) use($service_id, $budget){
                $query->where('cl_service_id', $service_id)
                    ->where('min_budget', '<', $budget);
            }])
            ->where('is_receiving_emails', 1)
            ->whereIn('user_type', [\Config::get('constants.USER_ROLE_SUPPLIER'), \Config::get('constants.USER_ROLE_ADMIN')])
            ->get();
        $emails_list = array();
        foreach ($users_for_email as $user_for_email) 
        {
            if(count($user_for_email->conUserServices) > 0 && array_intersect($regions_list, $user_for_email->conUserRegions->pluck('cl_region_id')->toArray()))
            {
                $emails_list[] = $user_for_email->email;
            }
        }
        $link = route('ads.show_ad', $ad_id);
        $message = sprintf("
            Има получена обява подходяща за вас \r\n<a href='%s'>%s</a>", 
            $link, $link
        );
        foreach ($emails_list as $email) 
        {
            $this->mailer->raw($message, function (Message $m) use ($email) {
                $m->to($email)->subject('Счетоводство.com - получена обява');
            });
        }
    }
    
    protected function single_ad(CmAd $cm_ad){
        $cl_region = $cm_ad->clRegion()->get();
        $cl_service = $cm_ad->clService()->get();
//        $cl_region = ClRegion::where('id',$cm_ad->cl_region_id)->get();
        return view('ads.single_ad',[
            'ad' => $cm_ad,
            'region' => $cl_region[0],
            'service' => $cl_service[0],
         ]);
    }
    
    protected function show_ad(CmAd $cm_ad){
        $cl_service = $cm_ad->clService()->get();
        $ad_offers = CmOffer::with('createdBy')->where('cm_ad_id', $cm_ad->id)->get();
        $has_user_approve_privilleges = false;
        if($cm_ad->created_by == \Auth::id() && empty($cm_ad->date_accepted))
        {
            $has_user_approve_privilleges = true;
        }

        $has_rating_privilleges = false;
        $cm_ratings = CmRating::where('cm_ad_id', $cm_ad->id)->first();
        $system_settings = SystemSetting::first();
        $dt = new \DateTime();
        $date_accepted = new \DateTime($cm_ad->date_accepted);
        date_add($date_accepted, date_interval_create_from_date_string("$system_settings->rating_period days"));
        $rating_deadline = $date_accepted->format('Y-m-d');
        $now = $dt->format('Y-m-d');

        if($cm_ad->created_by == \Auth::id() && !empty($cm_ad->date_accepted) && count($cm_ratings) == 0 && (strtotime($rating_deadline) > strtotime($now)))
        {
            $has_rating_privilleges = true;
        }
        
        return view('ads.show_ad',[
            'ad' => $cm_ad,
            'regions' => $cm_ad->clRegions()->get(),
            'service' => $cl_service[0],
            'count_all_regions' => ClRegion::get()->count(),
            'ad_offers' => $ad_offers,
            'has_user_approve_privilleges' => $has_user_approve_privilleges,
            'has_rating_privilleges' => $has_rating_privilleges,
         ]);
    }

    public function ads_list(Request $request = null){
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
            $received_ads = (new CmAd)->newQuery(); 
            $received_ads->with(array('clService'));

            $applied_filters = '';
            if($request->has('filter_region_id'))
            {
                $received_ads->with(['clRegions' => function($query) use($request){
                    $query->where('cl_region_id', $request->filter_region_id);
                }]);

                $selected_region = ClRegion::where('id', $request->filter_region_id)->first();
                $region_name = $selected_region->getTranslation(\Session::get('language'))->region;
                $applied_filters .= trans('ads.filtered_by_region') . $region_name;
            }
            else
            {
                $received_ads->with('clRegions');
            }

            if($request->has('filter_organization_type_id'))
            {
                $received_ads->with(['createdBy' => function($query) use($request){
                    $query->where('cl_organization_type_id', $request->filter_organization_type_id);
                }]);

                $selected_org_type = ClOrganizationType::where('id', $request->filter_organization_type_id)->first();
                $org_type_name = $selected_org_type->getTranslation(\Session::get('language'))->organization_type;
                $applied_filters .= trans('ads.filtered_by_org_type') . $org_type_name;
            }
            else
            {
                $received_ads->with('createdBy');
            }

            if($request->has('filter_service_id'))
            {
                $received_ads->where('service_id', $request->filter_service_id);

                $selected_service = ClService::where('id', $request->filter_service_id)->first();
                $service_name = $selected_service->getTranslation(\Session::get('language'))->service;
                $applied_filters .= trans('ads.filtered_by_service') . $service_name;
            }

            if($request->has('filter_by_min_budget'))
            {
                $received_ads->where('budget', '>=', $request->filter_by_min_budget);
                $applied_filters .= trans('ads.filtered_by_min_budget') . $request->filter_by_min_budget;
            }

            if($request->has('filter_by_max_budget'))
            {
                $received_ads->where('budget', '<=', $request->filter_by_max_budget);
                $applied_filters .= trans('ads.filtered_by_max_budget') . $request->filter_by_max_budget;
            }

            if($request->has('filter_by_content'))
            {
                $received_ads->with(['translations' => function($query) use($request){
                    $query->where('title', 'LIKE', "% $request->filter_organization_type_id %");
                }]);

                $applied_filters .= trans('ads.filtered_by_content') . $request->filter_by_content;
            }

            $received_ads->whereNull('date_accepted')
                    ->whereNull('date_deleted')
                    ->where([['created_by', '<>', \Auth::id()],
                             ['deadline','>=',date('Y-m-d').' 00:00:00']])
                    ->whereIn('service_id', array_keys($user_services))
                    ->orderBy('cm_ads.id', 'desc');
            $all_ads = $received_ads->get();
            //==================================================================
            $unanswered = $all_ads;
            // foreach ($all_ads as $ad){
            //     $ad_regions = array();
            //     foreach($ad->clRegions as $region){
            //         $ad_regions[] = $region['id'];
            //     }
            //     $ad_locale = $ad->getTranslation()['locale'];
            //     if (isset($user_languages[$ad_locale]) &&
            //         $ad->budget >= $user_services[$ad->service_id] && 
            //         array_intersect($user_regions,$ad_regions)){
            //         $unanswered[] = $ad;
            //     }
            // }
            //==================================================================
            $all_services = ClService::all();
            $all_regions = ClRegion::all();
            $all_org_types = ClOrganizationType::all();
            return view ('ads.ads_list', [
                'unanswered' => $unanswered,
                'answered' => $answered,
                'count_all_regions' => ClRegion::get()->count(),
                'all_services' => $all_services,
                'all_regions' => $all_regions,
                'all_org_types' => $all_org_types,
                'applied_filters' => $applied_filters,
            ]);
        }
    }
    
}

