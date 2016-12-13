@extends('layouts.unauthorized')

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
        </div>
    </section>
</div><!--Content Ends-->

<!--Header END
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
