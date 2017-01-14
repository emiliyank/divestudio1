<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CmAd;
use App\CmOffer;
use App\CmRating;
use App\CmArticle;
use App\CmArticleRating;

class CmRatingController extends Controller{

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

    public function add_form(CmAd $cm_ad, CmOffer $cm_offer)
    {
        return view('ratings.add_rating', [
            'cm_ad' => $cm_ad,
            'cm_offer' => $cm_offer,
            ]);
    }

    public function add_submit(Request $request){
        $this->validate($request, [
            'rating' => 'required|integer|min:1|max:5',
            ]);
        
        $cm_rating = new CmRating;
        $cm_rating->rating = $request->rating;
        $cm_rating->comment = $request->comment;

        $cm_rating->created_by = \Auth::id();
        $cm_rating->cm_ad_id = $request->cm_ad_id;
        $cm_rating->cm_offer_id = $request->cm_offer_id;
        $cm_rating->user_graded_id = $request->user_graded_id;
        
        $cm_rating->save();

        \Session::flash('rating_sent', trans('ratings.flash_rating_sent'));
        return redirect("/show_ad/$request->cm_ad_id");
    }
    
    public function client_rates_given(User $user)
    {
        
    }

    public function submit_article_rating(Request $request)
    {
        $cm_article_rating = CmArticleRating::firstOrNew(['cm_article_id' => $request->cm_article_id, 'created_by' => \Auth::id()]);
        $cm_article_rating->rating = $request->rating;
        $cm_article_rating->created_by = \Auth::id();
        $cm_article_rating->save();
    }
}

