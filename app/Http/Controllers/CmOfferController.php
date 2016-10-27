<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CmAd;
use App\CmOffer;
use App\ClRegion;
use App\ClService;

class CmOfferController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ad_offers_list(CmAd $cm_ad)
    {
        $cl_region = $cm_ad->clRegion()->get();
        $cl_service = $cm_ad->clService()->get();
        $cm_offers = $cm_ad->cmOffers()->with('createdBy')->get();

        
        return view('offers.ad_offers', [
            'cm_ad' => $cm_ad,
            'cm_offers' => $cm_offers,
            'region' => $cl_region[0],
            'service' => $cl_service[0],
        ]);
    }

    public function add_form(CmAd $cm_ad)
    {
        $cl_region = $cm_ad->clRegion()->get();
        $cl_service = $cm_ad->clService()->get();
        return view('offers.add_offer',[
            'cm_ad' => $cm_ad,
            'region' => $cl_region[0],
            'service' => $cl_service[0],
         ]);
    }

    public function add_submit(Request $request){
        $this->validate($request, [
            'price' => 'required|integer|min:1',
            'comment' => 'required|max:200',
            'deadline' => 'required|date_format:Y-m-d H:i',
	]);
        
        $offer = new CmOffer;
        $offer->cm_ad_id = $request->cm_ad_id;
        $offer->price = $request->price;
        $offer->comment = $request->comment;
        $offer->deadline = $request->deadline;
        $offer->created_by = \Auth::id();
        
        if(\Auth::id() == $request->cm_ad_id)
        {
            $offer->type = 'client';
        }else{
            $offer->type = 'supplier';
        }
        
        $offer->save();
        
        return redirect("/ad/" . $request->cm_ad_id);
    }

    public function approve_offer(CmOffer $cm_offer, Request $request)
    {
        $cm_offer->is_approved = 1;
        $cm_offer->updated_at = date('Y-m-d H:i:s');
        $cm_offer->updated_by = \Auth::id();

        $cm_offer->save();

        $cm_ad = CmAd::where('id', $request->cm_ad_id)->get();
        $cm_ad[0]->date_accepted = date('Y-m-d H:i:s');
        $cm_ad[0]->save();

        return redirect("/ad_offers/" . $request->cm_ad_id);
    }
}
