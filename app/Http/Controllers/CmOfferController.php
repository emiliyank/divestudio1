<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use App\CmAd;
use App\User;
use App\CmAdTranslation;
use App\CmOffer;
use App\CmOfferTranslation;
use App\ClRegion;
use App\ClService;

class CmOfferController extends Controller{

    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->middleware('auth');
        $this->mailer = $mailer;
    }

    public function index(Request $request)
    {
        $received_offers = (new CmOffer)->newQuery(); 
        $received_offers->with(['cmAd' => function($query){
                $query->whereNull('date_accepted')
                    ->where('created_by', \Auth::id());
            }])
            ->with(['createdBy.cmArticles' => function($query){
                $query->whereNotNull('date_approved');
            }])
            ->with(['createdBy', 'cmAd.createdBy', 'createdBy.cmRatings'])
            ->where('created_by', '!=', \Auth::id())
            ->orderBy('cm_ad_id');

        $date_order = '';
        if($request->has('date'))
        {
            $received_offers->orderBy('created_at', $request->date);
            $date_order = $request->date;
        }

        $price_order = '';
        if($request->has('price'))
        {
            $received_offers->orderBy('price', $request->price);
            $price_order = $request->price;
        }

        $offers = $received_offers->get();

        return view('offers.user_offers',[
            'received_offers' => $offers,
            'date_order' => $date_order,
            'price_order' => $price_order,
            ]);
    }

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

        //send email to the user that created the ad
        $cm_ad = CmAd::with('createdBy')->where('id', $request->cm_ad_id)->first();
        if($cm_ad->createdBy->is_receiving_emails && $cm_ad->createdBy->id != \Auth::id())
        {
            $email = $cm_ad->createdBy->email;
            $link = route('ads.show_ad', $request->cm_ad_id);
            $message = sprintf("
                Има получена оферта към вашата обява \r\n<a href='%s'>%s</a>", 
                $link, $link
            );
            $this->mailer->raw($message, function (Message $m) use ($email) {
                    $m->to($email)->subject('Счетоводство.com - получена оферта');
                });
        }
   
        \Session::flash('offer_sent', trans('offers.flash_offer_sent'));
        return redirect("/show_ad/$request->cm_ad_id");
    }

    public function approve_offer(CmOffer $cm_offer, Request $request)
    {
        $cm_offer->is_approved = 1;
        $cm_offer->updated_at = date('Y-m-d H:i:s');
        $cm_offer->updated_by = \Auth::id();

        $cm_offer->save();

        $cm_ad = CmAd::where('id', $cm_offer->cm_ad_id)->first();
        $cm_ad->date_accepted = date('Y-m-d H:i:s');
        $cm_ad->save();

        \Session::flash('offer_approve', trans('offers.flash_offer_approved'));
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
