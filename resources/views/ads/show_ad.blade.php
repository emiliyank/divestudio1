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
                                <a href="#">{{trans('ads.view_profile')}}</a>
                            </p>
@if (true)
                            <p class="send-message center">
                                <a href="javascript:void(0)" onClick="$('#conversation-reply-wrapper1').slideToggle(200, function() {equalheight('.boxes .box');});">
                                    {{trans('ads.write_message')}}
                                </a>
                            </p>
                            <div id="conversation-reply-wrapper1" style="display: none;">
                                <form id="reply-form1" method="post" action="/">
                                <fieldset>
                                    <textarea name="conversation-reply1" id="conversation-reply1" placeholder="{{trans('contact.feedback')}}" onFocus="focusLink(true)" onBlur="focusLink(false)"></textarea>
                                    <input type="submit" value="{{trans('ads.btn_sned')}}">
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
                            <p class="center"><em><strong>Имате 1 непрочетени съобщения.</strong></em></p>
                            <div class="conversation single">
                                <div class="conversation-me">
                                    <p class="conversation-sender"><a href="#">Бетон интелект ООД</a></p>
                                    <p class="conversation-message">Здравейте. Мога да ви консултирам по казуса. Консултацията ще струва 150 лв.</p>
                                    <p class="conversation-date">01.12.2016, 20:01</p>
				</div>
                                <div class="conversation-other-side">
                                    <p class="conversation-sender"><a href="#">Металика ЕООД</a></p>
                                    <p class="conversation-message deal"><i class="fa fa-handshake-ofa fa-thumbs-o-up" aria-hidden="true"></i> Желание за сключване на сделка</p>
                                    <p class="conversation-date">01.12.2016, 20:02</p>
                                </div>
                                <div class="conversation-me">
                                    <p class="conversation-sender"><a href="#">Бетон интелект ООД</a></p>
                                    <p class="conversation-message accept"><i class="fa fa-handshake-o" aria-hidden="true"></i> Сделката е приета</p>
                                    <p class="conversation-date">01.12.2016, 20:09</p>
                                    <p class="conversation-message">Дайте моля имейл, на който да ви изпратя проформа.</p>
                                    <p class="conversation-date">01.12.2016, 20:09</p>
				</div>
                                <div class="conversation-other-side">
                                    <p class="conversation-sender"><a href="#">Металика ЕООД</a></p>
                                    <p class="conversation-message unread">info@metclub.com</p>
                                    <p class="conversation-date">01.12.2016, 20:16</p>
                                </div>
                            </div>
<!-- ******************************************* -->
                            <p class="reply">
                                <a href="javascript:void(0)" onClick="$('#conversation-reply-wrapper2').slideToggle(200, function() {equalheight('.boxes .box');});">
                                    {{trans('ads.btn_reply')}}
                                </a>
                            </p>
                            <div id="conversation-reply-wrapper2" style="display: none;">
                                <form id="reply-form2" method="post" action="/">
                                <fieldset>
                                    <textarea name="conversation-reply2" id="conversation-reply2" placeholder="{{trans('ads.btn_reply')}}" onFocus="focusLink(true)" onBlur="focusLink(false)"></textarea>
                                    <input type="submit" value="{{trans('ads.btn_sned')}}">
                                </fieldset>
                                </form>
                            </div>
                        </div>
@endif
                    </div>

                    <p class="back center"><a href="{{url('/ads_list')}}">Към получени обяви</a></p>
                </div>

@endsection
