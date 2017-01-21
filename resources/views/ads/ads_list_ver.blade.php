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
                    <div class="user-box archive announcement">
                        <a href="{{url('/show_ad/'.$ad_id)}}">
                            <div class="container">
                                <p class="big">{{trans('ads.ad_title')}}: <strong>{{$cm_ad['title']}}</strong></p>
                                <p>{{trans('ads.author')}} <span class="blue">{{$cm_ad['from']}}</span></p>
                                <p>{{trans('ads.budget')}} <span class="red">BGN {{number_format($cm_ad['budget'],2)}}</span></p>
                                <p>{{trans('ads.deadline')}} <strong>{{$cm_ad['deadline']}}</strong></p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

@endsection