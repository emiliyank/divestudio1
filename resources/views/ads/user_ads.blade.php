@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>Моите обяви</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->

<section class="profile">
    <div class="container">
        <div class="boxes layout-left">
        <div class="box">
            
            @foreach($ads as $cm_ad)
            <div class="user-box">
                <div class="header">
                    <h5>{{$cm_ad->title}}</h5>
                </div>
                <div class="container">
                    <p class="author">{{trans('ads.author')}} <span>{{$cm_ad->createdBy->name}}</span></p>
                    <p class="tags">{{trans('ads.service')}} <span>{{$cm_ad->clService->getTranslation(\Session::get('language'))->service}}</span></p>
                    <p class="date">{{trans('ads.created_at')}} <span>{{$cm_ad->created_at}}</span></p>
                    <p>
                        {{trans('ads.content')}}
                    </p>
                    <p class="budget">{{trans('ads.budget')}} <span>{{$cm_ad->budget}}</span></p>
                    <p class="region">{{trans('ads.region')}} <span></span></p>
                    <p class="due-date">{{trans('ads.deadline')}} <span>{{$cm_ad->deadline}}</span></p>
                    <hr>
                    <p class="view-profile center"><a href="#">Прегледай профила</a></p>
                    <p class="send-message center"><a href="javascript:void(0)" onClick="$('#conversation-reply-wrapper1').slideToggle(200, function() {equalheight('.boxes .box');});">Напиши съобщение</a></p>
                    <div id="conversation-reply-wrapper1" style="display: none;">
                        <form id="reply-form1" method="post" action="/">
                        <fieldset>
                            <textarea name="conversation-reply1" id="conversation-reply1" placeholder="Съобщение" onFocus="focusLink(true)" onBlur="focusLink(false)"></textarea>
                            <input type="submit" value="Изпрати">
                        </fieldset>
                        </form>
                    </div>
                </div>
                <div class="messages">
                    <hr>
                    <p class="center"><em>Нямате съобщения</em></p>
                </div>
            </div> 
                
            @endforeach
        </div>
            

    
@endsection



