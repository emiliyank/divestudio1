<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CmAd;
use App\ClRegion;
use App\ClService;
use App\CmOffer;
use DB;

class AdController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
//        $ads = CmAd::where('created_by', \Auth::id())->get();
        
        $ads = DB::select(DB::raw("SELECT DISTINCT cm_ads.*,
                        (SELECT COUNT(*) FROM cm_offers WHERE cm_ad_id=cm_ads.id) AS offerCount
                        FROM cm_ads WHERE cm_ads.date_deleted IS NULL AND cm_ads.created_by=".\Auth::id()));
        $current='';
        $expired='';
        foreach ($ads as $ad){
            if ($ad->deadline > date('Y-m-d H:i:s')){
                $current.="<tr><td><a href='ad/$ad->id'>$ad->title</a></td><td>".
                          "$ad->offerCount</td><td>".substr($ad->deadline,0,16)."</td></tr>";
            }
            else{
                $expired.="<tr><td><a href='ad/$ad->id'>$ad->title</a></td>";
            }
        }

        return view('ads.user_ads', [
            'ads' => $ads,
            'current' => $current,
            'expired' => $expired,
        ]);
    }

    public function add_form(){
//        $regions_data = ClRegion::orderBy('region_order', 'desc')->orderBy('region_en', 'asc')->get();
//        $cl_regions = array();
//        foreach ($regions_data as $region) {
//            $cl_regions[$region['id']] = $region['region_en'];
//        }
//
//        $services_data = ClService::get();
//        $cl_services = array();
//        foreach ($services_data as $service) {
//            $cl_services[$service['id']] = $service['service_en'];
//        }

        return view('ads.add_ad', [
            'cl_regions' => ClRegion::orderBy('region_order', 'desc')->orderBy('region_en', 'asc')->get(),
            'cl_services' => ClService::get(),
        ]);
    }

    public function add_submit(Request $request){
        $this->validate($request, [
            'title' => 'required|max:200',
            'service_id' => 'required',
            'cl_region_id' => 'required',
            'content' => 'required|max:2000',
            'deadline' => 'required|date_format:Y-m-d H:i',
            'budget' => 'required|integer|min:1',
    ]);
        
        $ad = new CmAd;
        $ad->title = $request->title;
        $ad->created_by = \Auth::id();
        $ad->service_id = $request->service_id;
        $ad->cl_region_id = $request->cl_region_id;
        $ad->content = $request->content;
        $ad->deadline = date('Y-m-d H:i',strtotime($request->deadline));
        $ad->budget = $request->budget;
        
        $ad->save();
        
        return redirect('/ads');
    }
    
    protected function single_ad(CmAd $cm_ad){
        $cl_region = $cm_ad->clRegion()->get();
        $cl_service = $cm_ad->clService()->get();
//        $cm_offers = $cm_ad->cmOffer()->get();
        
        $cm_offers = CmOffer::where('cm_ad_id', $cm_ad->id)->get();
//        $cl_region = ClRegion::where('id',$cm_ad->cl_region_id)->get();
        return view('ads.single_ad',[
            'ad' => $cm_ad,
            'region' => $cl_region[0],
            'service' => $cl_service[0],
            'cm_offers' => $cm_offers,
         ]);
    }
    
    protected function delete(CmAd $cm_ad){
//        $this->authorize('destroy', $cm_ad);
        
        $cm_ad->updated_by = \Auth::id();
        $cm_ad->deleted_by = \Auth::id();
        $cm_ad->date_deleted = date('Y-m-d H:i:s');
        
        $cm_ad->save();
        
        return redirect('/ads');
    }
}
