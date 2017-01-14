@extends('layouts.dashboard')

@section('content')
<!--Header-->
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('users.admin_settings_title')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->

    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">

                    <form action="{{ url('/admin-settings') }}" method="post">
                        <fieldset>
                            <h4>{{trans('users.admin_settings_subtitle')}}</h4>

                            @if (Session::has('updated_data'))
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="alert alert-info">{{ Session::get('updated_data') }}</div>
                                </div>
                            </div>
                            @endif
                            {{ csrf_field() }}

                            <label for="ad-deadline-days">{{trans('users.default_ad_days_deadline')}}<span class="red">*</span>:</label>
                            <input type="text" name="default_ad_days_deadline" id="ad-deadline-days" required placeholder="{{trans('users.default_ad_days_deadline')}}*" value="{{$system_settings->default_ad_days_deadline}}">

                            <label for="rating-period-days">{{trans('users.rating_period')}}<span class="red">*</span>:</label>
                            <input type="text" name="rating_period" id="rating-period-days" required placeholder="{{trans('users.rating_period')}}*" value="{{$system_settings->rating_period}}">

                            <input type="submit" value="{{trans('common.btn_save')}}">
                        </fieldset>
                    </form>
                </div>

    @endsection



