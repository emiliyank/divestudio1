<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CmAd;
use App\ClRegion;
use App\ClService;

class AdController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        $ads = CmAd::where('created_by', \Auth::id())->get();
        
        return view('ads.user_ads', [
            'ads' => $ads,
        ]);
    }

    public function add_form(){

        $regions_data = ClRegion::orderBy('region_order', 'desc')->orderBy('region_en', 'asc')->get();
        $cl_regions = array();
        foreach ($regions_data as $region) {
            $cl_regions[$region['id']] = $region['region_en'];
        }

        $services_data = ClService::get();
        $cl_services = array();
        foreach ($services_data as $service) {
            $cl_services[$service['id']] = $service['service_en'];
        }
        
        return view('ads.add_ad', [
            'cl_regions' => $cl_regions,
            'cl_services' => $cl_services
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
//        $cl_region = ClRegion::where('id',$cm_ad->cl_region_id)->get();
        return view('ads.single_ad',[
            'ad' => $cm_ad,
            'region' => $cl_region[0],
            'service' => $cl_service[0],
         ]);
    }
}

