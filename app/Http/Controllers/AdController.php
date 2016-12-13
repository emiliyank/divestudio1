<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CmAd;
use App\ClRegion;
use App\ClService;
use App\ConAdRegion;

class AdController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        $ads = CmAd::with(array('clRegion', 'clService', 'createdBy'))->where('created_by', \Auth::id())->get();
        
        return view('ads.user_ads', [
            'ads' => $ads,
        ]);
    }

    public function add_form(){

        $regions_data = ClRegion::orderBy('region_order', 'desc')->get();
        $services_data = ClService::get();        
        
        return view('ads.add_ad', [
            'cl_regions' => $regions_data,
            'cl_services' => $services_data
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
        $ad->title = $request->title;
        $ad->created_by = \Auth::id();
        $ad->service_id = $request->service_id;
        $ad->content = $request->content;
        $ad->deadline = date('Y-m-d',strtotime($request->deadline));
        $ad->budget = $request->budget;
        
        $ad->save();

        $ad_id = $ad->id;
        foreach ($request->regions as $region) {
            $con_ad_region = new ConAdRegion;
            $con_ad_region->cm_ad_id = $ad_id;
            $con_ad_region->cl_region_id = $region;
            $con_ad_region->save();
        }
        
        return redirect('/ads');
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
        return view('ads.show_ad',[
            'ad' => $cm_ad,
            'regions' => $cm_ad->clRegions()->get(),
            'service' => $cl_service[0],
            'count_all_regions' => ClRegion::get()->count(),
         ]);
    }
    
}

