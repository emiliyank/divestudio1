@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('users.add_admin_user_title')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->

    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">
                    
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <form action="{{ url('/add-user') }}" method="post" class="form-horizontal">
                        <fieldset>
                            <h4>{{trans('users.add_admin_user_subtitle')}}</h4>
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="name">{{trans('users.admin_names')}}<span class="red">*</span>:</label>
                                    <input type="text" name="name" id="name" required placeholder="{{trans('users.admin_names')}}*" value="{{old('name')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="email">{{trans('users.email')}}<span class="red">*</span>:</label>
                                    <input type="text" name="email" id="email" required placeholder="{{trans('users.email')}}*" value="{{old('email')}}">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <input type="submit" value="{{trans('common.btn_save')}}">
                            </div>
                        </fieldset>
                    </form>
                </div>
@endsection



