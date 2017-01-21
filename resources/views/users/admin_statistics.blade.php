@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('users.admin_statistics_title')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->
    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">
                    <div class="article-filter center">
                        <p>
                            <a href="javascript:void(0)" onclick="show_only('')">{{trans('common.filter_all')}}</a>
                            <a href="javascript:void(0)" onclick="show_only('contracts_made')">{{trans('users.filter_contracts_made')}}</a>
                            <a href="javascript:void(0)" onclick="show_only('active_ads')">{{trans('users.filter_active_ads')}}</a>
                            <a href="javascript:void(0)" onclick="show_only('offers_list')">{{trans('users.filter_offers')}}</a>
                        </p>
                    </div>

                    <div class="user-box">
                        <div class="item-type" data-status='contracts_made' onClick="$('#contracts-made-wrapper').slideToggle(200, function() {equalheight('.boxes .box');});">
                            <h3 > {{trans('users.contracts_made')}} ({{$contracts_made->count()}})</h3>
                        </div>
                        
                        <div id="contracts-made-wrapper" style="display: none;">
                        @foreach($contracts_made as $contract)
                        <div class="user-box archive item-type" data-status='contracts_made'>
                            <a href='{{url("/show_ad/$contract->id")}}' target="_blank">
                                <div class="container">
                                    <p class="big">{{trans('ads.ad_title')}}: 
                                        <strong>
                                            @if($contract->hasTranslation(\Session::get('language')))
                                                {{$contract->getTranslation(\Session::get('language'))->title}}
                                            @else
                                                {{trans('users.no_title_translation')}}
                                            @endif
                                        </strong>
                                    </p>
                                    <p>{{trans('ads.created_at')}}: <strong>{{$contract->created_at}}</strong></p>
                                    <p>{{trans('ads.author')}} <span class="blue">{{$contract->createdBy->email}}</span></p>
                                    <p>{{trans('ads.budget')}} <span class="red">BGN {{number_format($contract->budget, 2)}}</span></p>
                                    <p>{{trans('ads.deadline')}} <strong>{{$contract->deadline}}</strong></p>
                                    <p>{{trans('ads.date_accepted')}}: <strong>{{$contract->date_accepted}}</strong></p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        </div>
                    </div>

                    <div class="user-box">
                        <div class="item-type" data-status='active_ads' onClick="$('#active-ads-wrapper').slideToggle(200, function() {equalheight('.boxes .box');});">
                            <h3> {{trans('users.active_ads')}} ({{$active_ads->count()}})</h3>
                        </div>

                        <div id="active-ads-wrapper" style="display: none;">
                            @foreach($active_ads as $cm_ad)
                            <div class="user-box archive item-type" data-status='active_ads'>
                                <a href='{{url("/show_ad/$cm_ad->id")}}' target="_blank">
                                    <div class="container">
                                        <p class="big">{{trans('ads.ad_title')}}: 
                                            <strong>
                                                @if($cm_ad->hasTranslation(\Session::get('language')))
                                                    {{$cm_ad->getTranslation(\Session::get('language'))->title}}
                                                @else
                                                    {{trans('users.no_title_translation')}}
                                                @endif
                                            </strong>
                                        </p>
                                        <p>{{trans('ads.created_at')}}: <strong>{{$cm_ad->created_at}}</strong></p>
                                        <p>{{trans('ads.author')}} <span class="blue">{{$cm_ad->createdBy->email}}</span></p>
                                        <p>{{trans('ads.budget')}} <span class="red">BGN {{number_format($cm_ad->budget, 2)}}</span></p>
                                        <p>{{trans('ads.deadline')}} <strong>{{$cm_ad->deadline}}</strong></p>
                                        <p>{{trans('ads.date_accepted')}}: <strong>{{$cm_ad->date_accepted}}</strong></p>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="user-box">
                        <div class="item-type" data-status='offers_list' onClick="$('#offers-wrapper').slideToggle(200, function() {equalheight('.boxes .box');});">
                            <h3> {{trans('users.offers_on_active_ads')}} ({{$offers_count}})</h3>
                        </div>

                        <div id="offers-wrapper" style="display: none;">
                            @foreach($offers_on_active_ads as $offers_array)
                                @foreach($offers_array as $cm_offer)
                                <div class="user-box archive item-type" data-status='offers_list'>
                                    <a href='{{url("/show_ad/$cm_offer->cm_ad_id")}}' target="_blank">
                                        <div class="container">
                                            <p class="big">{{trans('users.offer')}}: 
                                                <strong>
                                                    {{$cm_offer->comment}}
                                                </strong>
                                            </p>
                                            <p>{{trans('ads.created_at')}}: <strong>{{$cm_offer->created_at}}</strong></p>
                                            <p>{{trans('ads.author')}} <span class="blue">{{$cm_offer->createdBy->email}}</span></p>
                                            <p>{{trans('ads.budget')}} <span class="red">BGN {{number_format($cm_offer->price, 2)}}</span></p>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>

    <script type="text/javascript">
    function show_only(filter){
        $('.item-type').fadeOut();
        if (filter=='') { $('.item-type').fadeIn(); }
        else{ $('*[data-status="'+filter+'"]').fadeIn(); }
    }
    $('.cl_status_id').change(function(){
        $(this).closest('form').trigger('submit');
    });
    </script>
                </div>
@endsection