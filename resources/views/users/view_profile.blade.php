@extends('layouts.dashboard')

@section('content')
<!--Header-->
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('users.view_profile_title')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->

    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">
                    <h4>
                        {{trans('users.profile_of')}} 
                        @if($user->hasTranslation(\Session::get('language')))
                            {{$user->getTranslation(\Session::get('language'))->org_name}}
                        @else
                            {{trans('users.no_translation')}}
                        @endif
                    </h4>
                    <p>{{trans('users.registered_as')}} <strong><u>{{$user->userType->getTranslation(\Session::get('language'))->role}}</u></strong>.</p>
                    <hr>

                    <h5>{{trans('users.description')}}</h5>

                    <blockquote>
                        @if($user->hasTranslation(\Session::get('language')))
                            {{$user->getTranslation(\Session::get('language'))->description}}
                        @else
                            {{trans('users.no_translation')}}
                        @endif
                    </blockquote>
                    <hr>

                    <p><strong>{{trans('common.rating_of')}} 
                        @if($user->hasTranslation(\Session::get('language')))
                            {{$user->getTranslation(\Session::get('language'))->org_name}}
                        @else
                            {{trans('users.no_translation')}}
                        @endif
                    </strong></p>

                    <div class="rate-form" style="margin: -10px 0 30px 0;">
                        <fieldset class="rating">
                            <input type="radio" id="4star5" name="rating4" value="5" disabled><label for="4star5" title="Отлично">Отлично</label>
                            <input type="radio" id="4star4" name="rating4" value="4" disabled><label for="4star4" title="Много добро">Много добро</label>
                            <input type="radio" id="4star3" name="rating4" value="3" disabled checked><label for="4star3" title="Добро">Добро</label>
                            <input type="radio" id="4star2" name="rating4" value="2" disabled><label for="4star2" title="Средно">Средно</label>
                            <input type="radio" id="4star1" name="rating4" value="1" disabled><label for="4star1" title="Слабо">Слабо</label>
                        </fieldset>
                    </div>

                    <p><em>Оценили са ви 3 потребителя</em></p>

                    <hr>
                </div>

    @endsection



