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
                    <div class="user-box">
                        @if (Session::has('offer_sent'))
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-info">{{ Session::get('offer_sent') }}</div>
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

                        <div class="header">
                            <h5>{{$ad->title}}</h5>
                        </div>
                        <div class="container">
                            <p class="author">{{trans('ads.author')}}
                                <span>
@if ($ad->createdBy->getTranslation(\Session::get('language'))->org_name)
    {{$ad->createdBy->getTranslation(\Session::get('language'))->org_name}} -
@endif
    {{$ad->createdBy->getTranslation(\Session::get('language'))->name}}

                                </span>
                            </p>
                            <p class="tags">{{trans('ads.service')}}: 
                                <span>
                                    {{$service->getTranslation(\Session::get('language'))->service}}
                                </span>
                            </p>
                            <p class="date">{{trans('ads.created_at')}}
                                <span>{{date('d.m.Y',strtotime($ad->updated_at))}}</span>
                            </p>
                            <p>{{$ad->content}}</p>
                            <p class="budget">{{trans('ads.budget')}} 
                                <span> 
@if ($ad->budget)
    BGN {{number_format($ad->budget,2)}}
@else
    {{trans('ads.not_specified')}}
@endif
                                </span>
                            </p>
                            <p class="region">{{trans('ads.region')}}
                                <span>
@if (count($regions) == $count_all_regions)
    {{trans('ads.all')}}
@else
    @foreach($regions as $region)
                            {{$region->getTranslation(\Session::get('language'))->region}}; 
    @endforeach
@endif
                                </span>
                            </p>
                            <p class="due-date">{{trans('ads.deadline')}}
                                <span>{{date('d.m.Y',strtotime($ad->deadline))}}</span>
                            </p>
                            <hr>
                            <p class="view-profile center">
                                <a href='{{url("/view-profile/$ad->created_by")}}'>{{trans('ads.view_profile')}}</a>
                            </p>
                            
                            @if($is_ad_accepted)
                                <p class="is-accepted center">
                                    <a href="#" disabled>
                                        {{trans('ads.ad_accepted')}}
                                    </a>
                                </p>
                            @else
                                <p class="send-message center">
                                    <a href="javascript:void(0)" onClick="$('#conversation-reply-wrapper1').slideToggle(200, function() {equalheight('.boxes .box');});">
                                        {{trans('ads.write_message')}}
                                    </a>
                                </p>
                                <div id="conversation-reply-wrapper1" style="display: none;">
                                    <form id="reply-form1" method="post" action="{{url('/offer')}}">
                                    <fieldset>
                                        {{csrf_field()}}
                                        <input type="hidden" name="cm_ad_id" value="{{$ad->id}}"/>

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
@if (true)
                        <div class="messages">
                            <h5>{{trans('ads.messages')}}</h5>
                            <hr>
<!-- ******************************************* -->
                            <div class="conversation single">
                            @foreach($ad_offers as $offer)
                                @if($offer->created_by == \Auth::id())
                                    <div class="conversation-other-side">
                                @else
                                    <div class="conversation-me">
                                @endif

                                @if($offer->is_approved)
                                    <p class="conversation-message accept"><i class="fa fa-handshake-o" aria-hidden="true"></i> {{trans('offers.status_approved')}}</p>
                                    <p class="conversation-date">{{$offer->updated_at}}</p>
                                    @if($has_rating_privilleges)
                                        <p class="is-accepted center">
                                            <a href="javascript:void(0)" onClick="$('#conversation-rating-wrapper1').slideToggle(200, function() {equalheight('.boxes .box');});">
                                                {{trans('ads.add_rating_btn')}}
                                            </a>
                                        </p>
                                        <div id="conversation-rating-wrapper1" style="display: none;">
                                            <form id="rating-form1" method="post" action="{{url('/rating')}}">
                                                <fieldset>
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="cm_ad_id" value="{{$ad->id}}"/>
                                                    <input type="hidden" name="cm_offer_id" value="{{$offer->id}}"/>
                                                    <input type="hidden" name="user_graded_id" value="{{$offer->created_by}}"/>

                                                    <legend>{{trans('ads.rate_deal')}}: </legend>
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <input type="radio" name="rating" value="{{$i}}">{{$i}}
                                                    @endfor
                                                    
                                                    <label for="comment">{{trans('offers.comment')}}</label>
                                                    <textarea name="comment" id="comment" required placeholder="{{trans('offers.comment')}}">{{old('comment')}}</textarea>
                                                    
                                                    <input type="submit" value="{{trans('ads.btn_rating')}}">
                                                </fieldset>
                                            </form>
                                        </div>
                                    @endif
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

                                    @if($has_user_approve_privilleges && $offer->created_by != \Auth::id())
                                    <ul class="conversation-nav">
                                        <li><a href='{{url("/view-profile/$offer->created_by")}}' target="_blank">Покажи профила</a></li>
                                        <li><a href='{{url("/approve_offer/$offer->id")}}'>{{trans('ads.btn_approve')}}</a></li>
                                    </ul>
                                    @endif
                                </div>
                            @endforeach
                            </div>
@endif
                        </div>
                </div>
            </div>
@endsection
