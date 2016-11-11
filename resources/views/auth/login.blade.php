@extends('layouts.unauthorized')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>Вход</h2>
    </div>
</div>

<!--Header END-->
<div class="content"><!--Content Starts-->

<section>
    <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    <fieldset>
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="username form-control" name="email" value="{{ old('email') }}" placeholder="{{trans('auth.placeholder_username')}}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="password form-control" name="password" placeholder="{{trans('auth.placeholder_password')}}">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox float-left">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">{{trans('auth.remember_me')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="pass-forgot float-right">
                            <a class="btn btn-link" href="{{ url('/password/reset') }}">{{trans('auth.forgotten_pass')}}</a>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" value="{{trans('auth.btn_login')}}">
                            </div>
                        </div>
                    </fieldset>
                    </form>

                    <div class="center">
                        <p><strong>Нямате профил в Счетоводно.com?</strong></p>
                    
                        <div class="go-register"><a href="{{ url('register') }}">Регистрирай се</a></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </section>
    </div><!--Content Ends-->

</div>
@endsection
