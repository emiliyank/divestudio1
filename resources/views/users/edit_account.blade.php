@extends('layouts.dashboard')

@section('content')
<!--Header-->
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('users.account_title')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->

    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">
                    <h4>{{trans('users.account_subtitle')}}</h4>

                    @if (Session::has('updated_data'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info">{{ Session::get('updated_data') }}</div>
                        </div>
                    </div>
                    @endif
                    @if (Session::has('password_changed'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-warning">{{ Session::get('password_changed') }}</div>
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

                    <form action="{{ url('/account') }}" method="post">
                        <fieldset>
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{$user->id}}"/>

                            <label for="supply-name">{{trans('users.name')}}<span class="red">*</span>:</label>
                            <input type="text" name="name" id="supply-name" class="name" required placeholder="{{trans('users.name')}}*" value="@if($user->hasTranslation(\Session::get('language'))){{$user->getTranslation(\Session::get('language'))->name}}@endif">

                            <label for="supply-phone">{{trans('users.phone')}}<span class="red">*</span>:</label>
                            <input type="tel" name="phone" id="supply-phone" class="telephone" required placeholder="{{trans('users.phone')}}*" value="{{$user->phone}}">

                            <label for="demand-objectype">{{trans('users.org_type')}}</label>
                            <select name="cl_organization_type_id" id="demand-objectype">
                                <option value="">{{trans('users.org_type')}}</option>
                                @foreach($cl_organization_types as $org_type)
                                <?php
                                $selected = '';
                                if( ! empty($user->cl_organization_type_id == $org_type->id))
                                {
                                    $selected = 'selected';
                                }
                                ?>
                                <option value="{{$org_type->id}}" {{$selected}}>{{$org_type->getTranslation(\Session::get('language'))->organization_type}}</option>
                                @endforeach
                            </select>

                            <label for="supply-company">{{trans('users.org_name')}}</label>
                            <input type="text" name="org_name" id="supply-company" class="company" placeholder="{{trans('users.org_name')}}" value="@if($user->hasTranslation(\Session::get('language'))){{$user->getTranslation(\Session::get('language'))->org_name}}@endif">

                            <label for="supply-number">{{trans('users.reg_number')}}</label>
                            <input type="text" name="reg_number" id="supply-number" class="eik" placeholder="{{trans('users.reg_number')}}" value="{{$user->reg_number}}">

                            <label for="supply-vat">{{trans('users.vat_number')}}</label>
                            <input type="text" name="vat_number" id="supply-vat" class="dds" placeholder="{{trans('users.vat_number')}}" value="{{$user->vat_number}}">

                            <label for="supply-address">{{trans('users.address')}}</label>
                            <input type="text" name="address" id="supply-address" class="address" placeholder="{{trans('users.address')}}" value="@if($user->hasTranslation(\Session::get('language'))){{$user->getTranslation(\Session::get('language'))->address}}@endif">

                            <p>{{trans('users.change_password')}}</p>

                            <label for="supply-password">{{trans('users.old_password')}}</label>
                            <input type="password" name="old_password" id="supply-password" class="password" placeholder="{{trans('users.old_password')}}">

                            <label for="supply-password-retype">{{trans('users.old_password_confirmation')}}</label>
                            <input type="password" name="old_password_confirmation" id="supply-password-retype" class="password" placeholder="{{trans('users.old_password_confirmation')}}">

                            <label for="supply-password-new">{{trans('users.new_password')}}</label>
                            <input type="password" name="new_password" id="supply-password-new" class="password" placeholder="{{trans('users.new_password')}}*">

                            <label for="supply-password-new-retype">{{trans('users.new_password_confirmation')}}</label>
                            <input type="password" name="new_password_confirmation" id="supply-password-new-retype" class="password" placeholder="{{trans('users.new_password_confirmation')}}*">

                            <input type="submit" value="{{trans('common.btn_save')}}">
                        </fieldset>
                    </form>

                </div>

                @endsection



