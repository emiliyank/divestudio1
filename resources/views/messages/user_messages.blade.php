@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('messages.user_messages_title')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->
    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">
                    @foreach($all_user_messages as $key => $user_message)
                    <div class="user-box">
                        <div class="header profile">
                            <h5>
                                @if($user_message[0]->created_by == \Auth::id())
                                    @if($user_message[0]->toUser->hasTranslation(\Session::get('language')))
                                        {{$user_message[0]->toUser->getTranslation(\Session::get('language'))->name}}
                                    @endif
                                    &lt;{{$user_message[0]->toUser->email}}&gt;
                                @else
                                    @if($user_message[0]->createdBy->hasTranslation(\Session::get('language')))
                                        {{$user_message[0]->createdBy->getTranslation(\Session::get('language'))->name}}
                                    @endif
                                    &lt;{{$user_message[0]->createdBy->email}}&gt;
                                @endif
                            </h5>
                        </div>
                        <div class="container">
                            <hr>
                            <strong> {{trans('users.profile_of')}}: </strong>
                            @if($user_message[0]->created_by == \Auth::id())
                                @if($user_message[0]->toUser->hasTranslation(\Session::get('language')))
                                    {{$user_message[0]->toUser->getTranslation(\Session::get('language'))->org_name}}
                                @endif
                            @else
                                @if($user_message[0]->createdBy->hasTranslation(\Session::get('language')))
                                    {{$user_message[0]->createdBy->getTranslation(\Session::get('language'))->org_name}}
                                @endif
                            @endif
                            <p><strong>{{trans('users.description')}}:</strong></p>
                            <p>
                                @if($user_message[0]->created_by == \Auth::id())
                                    @if($user_message[0]->toUser->hasTranslation(\Session::get('language')))
                                        {{$user_message[0]->toUser->getTranslation(\Session::get('language'))->description}}
                                    @endif
                                @else
                                    @if($user_message[0]->createdBy->hasTranslation(\Session::get('language')))
                                        {{$user_message[0]->createdBy->getTranslation(\Session::get('language'))->description}}
                                    @endif
                                @endif
                            </p>
                            <hr>
                         </div>
                         <div class="messages">
                         <hr>
                         <p class="center">
                             <a href="javascript:void(0)" onClick='$("#messages-wrapper_{{$key}}").slideToggle(200, function() {equalheight(".boxes .box");});'>
                                {{trans('common.read_msgs')}} ({{count($user_message)}})
                            </a>
                         </p>
                        <div id="messages-wrapper_{{$key}}" style="display: none;">
                            <h5>Съобщения</h5>
                            <div class="conversation single">
                            @foreach($user_message as $message)
                                @if($message->created_by == \Auth::id())
                                    <div class="conversation-other-side">
                                @else
                                    <div class="conversation-me">
                                @endif
                                <p class="conversation-sender">
                                    <a href='{{url("/view-profile/$message->created_by")}}'>
                                        {{$message->createdBy->email}}
                                    </a>
                                </p>
                                <p class="conversation-message">
                                    {{$message->message}}
                                </p>
                                <p class="conversation-date">
                                   {{$message->created_at}}
                                </p>
                                </div>
                            @endforeach
                                <p class="reply">
                                    <a href="javascript:void(0)" onClick="$('#conversation-reply-wrapper_{{$key}}').slideToggle(200, function() {equalheight('.boxes .box');});">
                                        Отговор
                                    </a>
                                </p>
                                <div id="conversation-reply-wrapper_{{$key}}" style="display: none;">
                                    <form id="reply-form" method="post" action="{{url('/message')}}">
                                    <fieldset>
                                        {{csrf_field()}}
                                        <?php
                                            $receiver_id = $message->created_by;
                                            if($message->created_by == \Auth::id())
                                            {
                                                $receiver_id = $message->to_user_id;
                                            }
                                        ?>
                                        <input type="hidden" name="to_user_id" value="{{$receiver_id}}"/>

                                        <label for="message">{{trans('messages.message')}}</label>
                                        <textarea name="message" id="message" required placeholder="{{trans('messages.message')}}">{{old('message')}}</textarea>
                                        
                                        <input type="submit" value="{{trans('messages.btn_send')}}">
                                    </fieldset>
                                    </form>
                                </div>
                            </div><!--Conversation Single End-->
                        </div> <!--Msg Wraper End-->
                        </div>
                    </div>
                    @endforeach
                </div>
                
@endsection

