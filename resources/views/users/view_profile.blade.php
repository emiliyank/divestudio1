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
                    @if (Session::has('message_sent'))
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-success">{{ Session::get('message_sent') }}</div>
                            </div>
                        </div>
                    @endif
                    <div class="user-box">
                        <p class="send-message center">
                            <a href="javascript:void(0)" onClick="$('#conversation-msg').slideToggle(200, function() {equalheight('.boxes .box');});">
                                {{trans('messages.write_message')}}
                            </a>
                        </p>
                        <div id="conversation-msg" style="display: none;">
                            <form id="send-msg" method="post" action="{{url('/message')}}">
                            <fieldset>
                                {{csrf_field()}}
                                <input type="hidden" name="to_user_id" value="{{$user->id}}"/>

                                <label for="message">{{trans('messages.message')}}</label>
                                <textarea name="message" id="message" required placeholder="{{trans('messages.message')}}">{{old('message')}}</textarea>
                                
                                <input type="submit" value="{{trans('messages.btn_send')}}">
                            </fieldset>
                            </form>
                        </div>
                    </div>
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
                    <?php
                    $ratings_count = count($user->cmRatings);
                    if( $ratings_count > 0)
                    {
                        $avg_rating = $user->cmRatings->avg('rating');
                    }else
                    {
                        $avg_rating = 'Няма оценки';
                    }
                    ?>
                    <p><strong>{{trans('common.rating_of')}} 
                        @if($user->hasTranslation(\Session::get('language')))
                            {{$user->getTranslation(\Session::get('language'))->org_name}}
                        @else
                            {{trans('users.no_translation')}}
                        @endif
                    </strong></p>
                    <legend>{{trans('articles.average_rating')}}: {{$avg_rating}}</legend>
                    <p><em>Оценен от {{$ratings_count}} потребителя</em></p>
                    <hr>
                </div>

    @endsection



