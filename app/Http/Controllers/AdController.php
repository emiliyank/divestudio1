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

    public function index(){
        
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

        $is_ad_accepted = false;
        if( ! empty($cm_ad->date_accepted))
        {
            $is_ad_accepted = true;
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
            'is_ad_accepted' => $is_ad_accepted,
            'has_user_approve_privilleges' => $has_user_approve_privilleges,
            'has_rating_privilleges' => $has_rating_privilleges,
         ]);
    }
    
}

