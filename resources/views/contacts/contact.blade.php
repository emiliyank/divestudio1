@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('contact.contacts')}}</h2>
    </div>
</div>

<!--Header END-->
<div class="content"><!--Content Starts-->
    <section class="profile">
        <div class="container">
        <div class="boxes layout-left">
        <div class="box">
            <p class="center">{{trans('contact.text1')}} <a href="#">{{trans('common.asked_questions')}}.</a></p>
            <p class="small center">{{trans('contact.text2')}} (<span class="red">*</span>) {{trans('contact.text3')}}.</p>
            
@if ($errors->any())
    @foreach($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
@endif 

            <div class="show-labels">
                <form id="contact-form" method="post" action="{{url('/contact')}}">
                <fieldset>
                    {{ csrf_field() }}
                
                    <label for="contact-name">{{trans('users.name')}}<span class="red">*</span>:</label>
@if ($errors->has('name'))<strong>{{ $errors->first('name') }}</strong>@endif
                    <input type="text" name="name" id="name" required placeholder="{{trans('users.name')}}*" value="{{ old('name') }}">
                    
                    <label for="email">Email<span class="red">*</span>:</label>
@if ($errors->has('email'))<strong>{{$errors->first('email')}}</strong>@endif
                    <input type="email" name="email" id="email" required placeholder="Email*" value="{{ old('email') }}">
                
                    <label for="phone">{{trans('users.phone')}}:</label>
                    <input type="tel" name="phone" id="phone" placeholder="{{trans('users.phone')}}" value="{{ old('phone') }}">
                    
                    <label for="cl_feedback_topic_id">{{trans('contact.theme')}}:</label>
@if ($errors->has('cl_feedback_topic_id'))<strong>{{ $errors->first('cl_feedback_topic_id') }}</strong>@endif
                    <select name="cl_feedback_topic_id" id="cl_feedback_topic_id">
                        <option value="" selected>{{trans('common.please_select')}}:</option>
@foreach($cl_feedback_topics as $feedback_topic)
                        <option value="{{$feedback_topic->id}}" {{(old('cl_feedback_topic_id')==$feedback_topic->id) ? "selected":""}}>{{$feedback_topic->getTranslation(\Session::get('language'))->feedback_topic}}</option>
@endforeach
                    </select>

                    <label for="feedback">{{trans('contact.feedback')}}<span class="red">*</span>:</label>
@if ($errors->has('message'))<strong>{{$errors->first('feedback')}}</strong>@endif
                    <textarea name="feedback" id="feedback" required placeholder="{{trans('contact.feedback')}}*" onFocus="focusLink(true)" onBlur="focusLink(false)">{{old('feedback')}}</textarea>
                    
                    <input type="submit" value="{{trans('common.btn_continue')}}">
                    
                </fieldset>
                </form>
            </div>
        </div>
@endsection

