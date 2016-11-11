<?php

namespace App\Http\Middleware;

use Closure;
use App\ClSystemSetting;

class RatingPrivillegesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cm_ad = $request->route('cm_ad');
        if($cm_ad->created_by != \Auth::id())
        {
            return redirect('ad/' . $cm_ad->id)->with('rating_ad_privillege', "You do NOT have privilleges to rate this ad!");
        }

        $days_setting = ClSystemSetting::first();
        $days_interval = $days_setting->rating_period;
        $now = date('Y-m-d H:i:s');
        
        $deadline_date = new \DateTime("$cm_ad->date_accepted");
        $deadline_date = $deadline_date->add(new \DateInterval("P$days_interval" . 'D'));
        //TODO - add working period: Deadline by the client or by the supplier?

        if($deadline_date->format('Y-m-d H:i:s') < $now)
        {
            return redirect('ad/' . $cm_ad->id)->with('rating_ad_expired', "Sorry, rating this ad has expired! You have $days_interval to rate a finished work!");
        }

        return $next($request);
    }
}
