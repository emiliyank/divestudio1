@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('ads.received_ads')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->
    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">
@foreach($unanswered as $ad_id => $cm_ad)
                    <div class="user-box">
                        <div class="header">
                            <h5>{{$cm_ad->title}}</h5>
                        </div>
                        <div class="container">
                            <p class="author">{{trans('ads.author')}}
                                <span>
@if ($cm_ad->createdBy->getTranslation(\Session::get('language'))->org_name)
    {{$cm_ad->createdBy->getTranslation(\Session::get('language'))->org_name}} -
@endif
    {{$cm_ad->createdBy->getTranslation(\Session::get('language'))->name}}
                                </span>
                            </p>
                            <p class="tags">{{trans('ads.service')}}: 
                                <span>
                                    {{$cm_ad->clService->getTranslation(\Session::get('language'))->service}}
                                </span>
                            </p>
                            <p class="date">{{trans('ads.created_at')}}
                                <span>{{date('d.m.Y',strtotime($cm_ad->updated_at))}}</span>
                            </p>
                            <p>{{$cm_ad->content}}</p>
                            <p class="budget">{{trans('ads.budget')}} 
                                <span> 
@if ($cm_ad->budget)
    BGN {{number_format($cm_ad->budget,2)}}
@else
    {{trans('ads.not_specified')}}
@endif
                                </span>
                            </p>
                            <p class="region">{{trans('ads.region')}}
@if (count($cm_ad->clRegions) == $count_all_regions)
                                <span>{{trans('ads.all')}}</span>
@else
    @foreach($cm_ad->clRegions as $region)
                                <span>{{$region->getTranslation(\Session::get('language'))->region}}</span>
    @endforeach
@endif
                            </p>
                            <p class="due-date">{{trans('ads.deadline')}}
                                <span>{{date('d.m.Y',strtotime($cm_ad->deadline))}}</span>
                            </p>
                            <hr>
                            <p class="view-profile center">
                                <a href="#">{{trans('ads.view_profile')}}</a>
                            </p>
                            <p class="send-message center">
                                <a href="javascript:void(0)" onClick="$('#conversation-reply-wrapper{{$cm_ad->id}}').slideToggle(200, function() {equalheight('.boxes .box');});">
                                    {{trans('ads.write_message')}}
                                </a>
                            </p>
                            <div id="conversation-reply-wrapper{{$cm_ad->id}}" style="display: none;">
                                <form id="reply-form{{$cm_ad->id}}" method="post" action="/">
                                <fieldset>
                                    <textarea name="conversation-reply[{{$cm_ad->id}}]" id="conversation-reply{{$cm_ad->id}}" placeholder="{{trans('contact.feedback')}}" onFocus="focusLink(true)" onBlur="focusLink(false)"></textarea>
                                    <input type="submit" value="{{trans('ads.btn_sned')}}">
                                </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
@endforeach
                </div>

@endsection

