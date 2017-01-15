@extends('layouts.dashboard')

@section('content')
<!--Header-->
<div class="header small">
    <div class="overlay">
        <h2>{{trans('register.forgotten_password')}}</h2>
    </div>
</div>
<!--Header END-->
<div class="content"><!--Content Starts-->
    <section>
        <div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
        <form  method="POST" action="{{url('/password/email')}}">
        <fieldset>
            {{ csrf_field() }}
            <label for="email">Email<span class="red">*</span>:</label>
            @if ($errors->has('email'))<strong>{{$errors->first('email')}}</strong>@endif
            <input type="email" name="email" id="email" class="email" required placeholder="Email*" value="{{ old('email') }}">
            <input type="submit" value="{{trans('register.send_password_reset_link')}}">
        </fieldset>  
        </form>
@endsection
