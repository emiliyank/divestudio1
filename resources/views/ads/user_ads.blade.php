@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('ads.user_ads_title')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->

<section class="profile">
    <div class="container">
        <div class="boxes layout-left">
        <div class="box">
            
            @foreach($ads as $cm_ad)
            @if($cm_ad->hasTranslation(\Session::get('language')))
            <div class="user-box">
                <div class="header">
                    <h5>
                        {{$cm_ad->getTranslation(\Session::get('language'))->title}}
                    </h5>
                </div>
                <div class="container">
                    <p class="author">{{trans('ads.author')}} <span>{{$cm_ad->createdBy->name}}</span></p>
                    <p class="tags">{{trans('ads.service')}} <span>{{$cm_ad->clService->getTranslation(\Session::get('language'))->service}}</span></p>
                    <p class="date">{{trans('ads.created_at')}} <span>{{$cm_ad->created_at}}</span></p>
                    <p>
                        {{$cm_ad->getTranslation(\Session::get('language'))->content}}
                    </p>
                    <p class="budget">{{trans('ads.budget')}} <span>{{$cm_ad->budget}}</span></p>
                    <p class="region">{{trans('ads.region')}}
                        @foreach($cm_ad->clRegions as $cl_region)
                        <span>
                            {{ $cl_region->getTranslation(\Session::get('language'))->region }}
                        </span>
                        @endforeach
                    </p>
                    <p class="due-date">{{trans('ads.deadline')}} <span>{{$cm_ad->deadline}}</span></p>
                    <hr>
                    <p class="view-profile center"><a href="#">{{trans('common.view_profile')}}</a></p>
                    <p class="send-message center"><a href="javascript:void(0)" onClick="$('#conversation-reply-wrapper1').slideToggle(200, function() {equalheight('.boxes .box');});">{{trans('common.write_msg')}}</a></p>
                    <div id="conversation-reply-wrapper1" style="display: none;">
                        <form id="reply-form1" method="post" action="/">
                        <fieldset>
                            <textarea name="conversation-reply1" id="conversation-reply1" placeholder="Съобщение" onFocus="focusLink(true)" onBlur="focusLink(false)"></textarea>
                            <input type="submit" value="Изпрати">
                        </fieldset>
                        </form>
                    </div>
                </div>
                <div class="messages">
                    <hr>
                    <p class="center"><em>{{trans('common.no_msgs')}}</em></p>
                </div>
            </div> 
            @endif
            @endforeach
        </div>
            

    
@endsection



