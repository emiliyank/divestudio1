@extends('layouts.unauthorized')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('contact.contacts')}}</h2>
    </div>
</div>

<!--Header END-->
<div class="content"><!--Content Starts-->
    <section>
        <div class="container">
            <form method="post" action="{{url('/contact/ok')}}">
                {{ csrf_field() }}
                <h4>{{trans('contact.success')}}.</h4><br/>
                <input type="submit" value="{{trans('common.btn_continue')}}">
            </form>
        </div>
    </section>
</div><!--Content Ends-->
@endsection


