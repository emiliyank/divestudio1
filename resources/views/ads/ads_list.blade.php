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
                        <p class="send-message center">
                            <a href="javascript:void(0)" onClick="$('#filter-wrapper').slideToggle(200, function() {equalheight('.boxes .box');});">
                                {{trans('ads.add_filters')}}
                            </a>
                        </p>
                        <div id="filter-wrapper" style="display: none;">
                            <form id="filter-form" method="post" action="{{url('/ads-list')}}">
                            <fieldset>
                                {{csrf_field()}}
                                <select name="filter_service_id">
                                    <option value="">{{trans('ads.filter_by_service_placeholder')}}</option>
                                    @foreach($all_services as $service)
                                        <option value="{{$service->id}}">
                                            @if($service->hasTranslation(\Session::get('language')))
                                                {{$service->getTranslation(\Session::get('language'))->service}}
                                            @else
                                                {{trans('ads.no_service_translation')}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>

                                <select name="filter_region_id">
                                    <option value="">{{trans('ads.filter_by_regions_placeholder')}}</option>
                                    @foreach($all_regions as $region)
                                        <option value="{{$region->id}}">
                                            @if($region->hasTranslation(\Session::get('language')))
                                                {{$region->getTranslation(\Session::get('language'))->region}}
                                            @else
                                                {{trans('ads.no_region_translation')}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>

                                <select name="filter_organization_type_id">
                                    <option value="">{{trans('ads.filter_by_org_types_placeholder')}}</option>
                                    @foreach($all_org_types as $org_type)
                                        <option value="{{$org_type->id}}">
                                            @if($org_type->hasTranslation(\Session::get('language')))
                                                {{$org_type->getTranslation(\Session::get('language'))->organization_type}}
                                            @else
                                                {{trans('ads.no_org_type_translation')}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>

                                <input type="number" name="filter_by_min_budget" placeholder="{{trans('ads.filter_by_min_budget_placeholder')}}">
                                <input type="number" name="filter_by_max_budget" placeholder="{{trans('ads.filter_by_max_budget_placeholder')}}">
                                
                                <input type="submit" value="{{trans('ads.btn_filter')}}">
                            </fieldset>
                            </form>
                        </div>
                    </div>

                    <div class="article-filter center">
                        {{trans('ads.filtered_by')}}:
                        <span> {{$applied_filters}}</span>
                    </div>

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
                            <p class="reply center">
                                <a href='{{url("show_ad/$cm_ad->id")}}'>{{trans('ads.view_ad')}}</a>
                            </p>
                            <p class="view-profile center">
                                <a href='{{url("/view-profile/$cm_ad->created_by")}}' target="_blank">{{trans('common.view_profile')}}</a>
                            </p>
                        </div>
                    </div>
@endforeach
                </div>

@endsection

