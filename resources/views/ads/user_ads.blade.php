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
            @if (Session::has('offer_sent'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success">{{ Session::get('offer_sent') }}</div>
                </div>
            </div>
            @endif
            @if (Session::has('offer_approve'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success">{{ Session::get('offer_approve') }}</div>
                </div>
            </div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

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
                    <p class="reply center"><a href='{{url("show_ad/$cm_ad->id")}}'>{{trans('ads.view_ad')}}</a></p>
                    <p class="view-profile center"><a href='{{url("/view-profile/$cm_ad->created_by")}}' target="_blank">{{trans('common.view_profile')}}</a></p>
                    @if(! empty($cm_ad->date_accepted))
                        <p class="is-accepted center">
                            <a href="#" disabled>
                                {{trans('ads.ad_accepted')}}
                            </a>
                        </p>
                    @else
                    <p class="send-message center"><a href="javascript:void(0)" onClick="$('#conversation-reply-wrapper_{{$cm_ad->id}}').slideToggle(200, function() {equalheight('.boxes .box');});">{{trans('ads.write_message')}}</a></p>
                    <div id="conversation-reply-wrapper_{{$cm_ad->id}}" style="display: none;">
                        <form id="reply-form1" method="post" action="{{url('/offer')}}">
                        <fieldset>
                            {{csrf_field()}}
                            <input type="hidden" name="cm_ad_id" value="{{$cm_ad->id}}"/>

                            <label for="price">{{trans('offers.price')}}</label>
                            <input type="number" name="price" class="budget" id="price" value="{{old('price')}}" required placeholder="{{trans('offers.price')}}"/>
                            
                            <label for="comment">{{trans('offers.comment')}}</label>
                            <textarea name="comment" id="comment" required placeholder="{{trans('offers.comment')}}">{{old('comment')}}</textarea>
                            
                            <input type="submit" value="{{trans('ads.btn_offer')}}">
                        </fieldset>
                        </form>
                    </div>
                    @endif
                </div>
                <div class="messages">
                    <hr>
                    <p class="center">
                        @if( count($cm_ad->cmOffers) > 0)
                            <a href="javascript:void(0)" onClick='$("#offers-wrapper_{{$cm_ad->id}}").slideToggle(200, function() {equalheight(".boxes .box");});'>
                                {{trans('common.read_msgs')}}
                            </a>
                            <?php
                                $has_user_approve_privilleges = false;
                                if($cm_ad->created_by == \Auth::id() && empty($cm_ad->date_accepted))
                                {
                                    $has_user_approve_privilleges = true;
                                }

                            ?>
                            <div id="offers-wrapper_{{$cm_ad->id}}" style="display: none;">
                                <div class="conversation single">
                            @foreach($cm_ad->cmOffers as $offer)
                                @if($offer->created_by == \Auth::id())
                                    <div class="conversation-other-side">
                                @else
                                    <div class="conversation-me">
                                @endif
                                    <p class="conversation-sender"><a href='{{url("/view-profile/$offer->created_by")}}' target="_blank">
                                        @if($offer->createdBy->hasTranslation(\Session::get('language')))
                                            {{$offer->createdBy->getTranslation(\Session::get('language'))->org_name}}  
                                        @else
                                            {{trans('common.no_translation')}}
                                        @endif
                                        &lt;{{$offer->createdBy->email}}&gt;
                                    </a></p>
                                    <p class="conversation-message">{{$offer->comment}}</p>
                                    <p class="conversation-date"><span class="budget">{{$offer->price}} лв.</span> {{$offer->created_at}}</p>

                                    @if($offer->is_approved)
                                        <p class="conversation-message accept"><i class="fa fa-handshake-o" aria-hidden="true"></i> {{trans('offers.status_approved')}}</p>
                                        <p class="conversation-date">{{$offer->updated_at}}</p>
                                    @endif

                                    @if($has_user_approve_privilleges && $offer->created_by != \Auth::id())
                                    <ul class="conversation-nav">
                                        <li><a href='{{url("/view-profile/$offer->created_by")}}' target="_blank">Покажи профила</a></li>
                                        <li><a href='{{url("/approve_offer/$offer->id")}}'>{{trans('ads.btn_approve')}}</a></li>
                                    </ul>
                                    @endif
                                </div>
                            @endforeach
                            </div>
                            </div>
                        @else
                            {{trans('common.no_msgs')}}
                        @endif
                    </p>
                </div>
            </div>
            @endif
            @endforeach
        </div>
            
@endsection



