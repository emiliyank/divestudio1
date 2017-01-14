<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;

use App\CmAd;
use App\User;
use App\CmAdTranslation;
use App\CmOffer;
use App\CmOfferTranslation;
use App\ClRegion;
use App\ClService;

class CmOfferController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function ad_offers_list(CmAd $cm_ad)
    // {
    //     $cl_region = $cm_ad->clRegion()->first();
    //     $cl_service = $cm_ad->clService()->first();
    //     $cm_offers = $cm_ad->cmOffers()->get();
        
    //     return view('offers.ad_offers', [
    //         'cm_ad' => $cm_ad,
    //         'cm_offers' => $cm_offers,
    //         'region' => $cl_region,
    //         'service' => $cl_service,
    //         ]);
    // }

    // public function add_form(CmAd $cm_ad)
    // {
    //     $cl_region = $cm_ad->clRegion()->first();
    //     $cl_service = $cm_ad->clService()->first();

    //     return view('offers.add_offer',[
    //         'cm_ad' => $cm_ad,
    //         'region' => $cl_region,
    //         'service' => $cl_service,
    //         ]);
    // }

    public function add_submit(Request $request){
        $this->validate($request, [
            'price' => 'required|integer|min:1',
            'comment' => 'required|max:2000',
            ]);

        $logged_user = User::where('id', \Auth::id())->first();
        
        $offer = new CmOffer;
        $offer->cm_ad_id = $request->cm_ad_id;
        $offer->price = $request->price;
        $offer->comment = $request->comment;
        $offer->user_type = $logged_user->user_type;
        $offer->created_by = \Auth::id();
        $offer->save();

        // $translation = $offer->getNewTranslation(\Session::get('language'));
        // $translation->cm_offer_id = $offer->id;
        // $translation->comment = $request->comment;
        //  $translation->save();
        

        //Send notification email to the client
        // $to = $logged_user->email;
        // $data = array('from' => "You have new offer!");
        // Mail::queue('emails.offer_sent', $data, function ($message) use ($to){
        //     $message->from('no-reply@divestudio.com', 'Inveitix');
        //     $message->to($to);
        //     $message->subject('DiveStudio Platform');
        // });
        //TODO for windows&xampp: https://laracasts.com/discuss/channels/general-discussion/curl-error-60-ssl-certificate-problem-unable-to-get-local-issuer-certificate/replies/37017
        
        \Session::flash('offer_sent', trans('offers.flash_offer_sent'));
        return redirect("/show_ad/$request->cm_ad_id");
    }

    public function approve_offer(CmOffer $cm_offer, Request $request)
    {
        //$cm_offer = CmOffer::where('id', $request->cm_offer_id)->first();

        $cm_offer->is_approved = 1;
        $cm_offer->updated_at = date('Y-m-d H:i:s');
        $cm_offer->updated_by = \Auth::id();

        $cm_offer->save();

        $cm_ad = CmAd::where('id', $cm_offer->cm_ad_id)->first();
        $cm_ad->date_accepted = date('Y-m-d H:i:s');
        $cm_ad->save();

        return redirect("/show_ad/$cm_ad->id");
    }

    public function add_translation_form(CmAd $cm_ad, CmOffer $cm_offer)
    {
        $cl_region = $cm_ad->clRegion()->get();
        $cl_service = $cm_ad->clService()->get();
        return view('offers.add_offer_translation',[
            'cm_ad' => $cm_ad,
            'region' => $cl_region[0],
            'service' => $cl_service[0],
            'cm_offer' => $cm_offer,
            ]);
    }

    public function add_translation_submit(CmOffer $cm_offer, Request $request){
        $this->validate($request, [
            'comment' => 'required|max:200',
            ]);

        //$cm_offer = CmOffer::where('id', $request->cm_offer_id)->get();

        $lang = \Session::get('language');

        if( ! $cm_offer->hasTranslation($lang))
        {
            $translation = $cm_offer->getNewTranslation($lang);
            $translation->cm_offer_id = $cm_offer->id;
            $translation->comment = $request->comment;

            if(\Auth::id() == $request->cm_ad_id)
            {
                if(\Session::get('language') == 'bg')
                {
                    $translation->type = 'клиент';
                }else{
                    $translation->type = 'client';
                }
                
            }else{
                if(\Session::get('language') == 'bg')
                {
                    $translation->type = 'доставчик';
                }else{
                    $translation->type = 'supplier';
                }
            }
            $translation->save();
        }
        
        return redirect("/ad_offers/" . $request->cm_ad_id);
    }
}
