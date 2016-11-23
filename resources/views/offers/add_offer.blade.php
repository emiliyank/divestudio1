@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('ads.ad_title')}}</h2>
    </div>
</div>

<!--Header END-->
<div class="content"><!--Content Starts-->

<section class="profile">
    <div class="container">
        <div class="boxes layout-left">
        <div class="box">

            <div class="user-box">
                <div class="header">
                    <h5>{{$cm_ad->title}}</h5>
                </div>
                <div class="container">
                    <p class="author">{{trans('ads.author')}} <span>Металика ЕООД</span></p>
                    <p class="tags">{{trans('ads.service')}} <span>{{$service->getTranslation(\Session::get('language'))->service}}</span></p>
                    <p class="date">{{trans('ads.created_at')}} <span>01.12.2016</span></p>
                    <p>
                        {{trans('ads.content')}}
                    </p>
                    <p class="budget">{{trans('ads.budget')}} <span>{{$cm_ad->budget}}</span></p>
                    <p class="region">{{trans('ads.region')}} <span>{{$region->getTranslation(\Session::get('language'))->region}}</span></p>
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
            </div>
        </div>
        </div>
    </div>
</section>

    @if($cm_ad->date_accepted)
        This add is already approved on {{$cm_ad->date_accepted}}. You cannot place offer.
    @else
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

<div class="content"><!--Content Starts-->

<section class="profile">
    <div class="container">
        <div class="boxes layout-left">
        <div class="box">
    {!! Form::open(array('url' => 'offer', 'method' => 'post', 'class' => 'form-horizontal')) !!}
    <?php
        echo Form::hidden('cm_ad_id', $cm_ad->id, array('class' => 'form-control'));
        echo Form::hidden('ad_user_id', $cm_ad->created_by, array('class' => 'form-control'));

        echo '<div class="row">';
        echo '<div class="form-group">';
            echo Form::text('price', e(old('price')), array('class' => 'form-control', 'placeholder' => trans('offers.price')));
        echo '</div> </div>';

        echo '<div class="row">';
        echo '<div class="form-group">';
            echo Form::textarea ('comment', e(old('comment')), array('class' => 'form-control', 'placeholder' => trans('offers.comment')));
        echo '</div> </div>';

        echo '<div class="row">';
        echo '<div class="form-group" id="datetimepicker1">';
    ?>
    <script>
        $(function() {
            $( "#date" ).datepicker({
                  showOn: "both",
                  buttonImage: "img/date-button.svg",
                  buttonImageOnly: true,
                  buttonText: "Select date",
                  dateFormat: 'dd-mm-yy'
            });
            //$("img.ui-datepicker-trigger").replaceWith("<div class='date-button'></div>");
        });
    </script>
    <input type="text" name="deadline" id="date" value="" class="date-picker" placeholder=trans(offers.deadline)>;
   
    <?php
            //echo Form::text('deadline', e(old('deadline')), array('class' => 'form-control' , 'placeholder' => ));
        echo '</div> </div>';

        echo Form::submit(trans('offers.btn_add'));
    ?>
    {!! Form::close() !!}
    @endif

    
@endsection
