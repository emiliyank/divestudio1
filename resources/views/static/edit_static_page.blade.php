@extends('layouts.dashboard')

@section('content')
<script>
$(document).ready(function(){
    CKEDITOR.replace( 'content' );
});
</script>

<!--Header-->
<div class="header small">
    <div class="overlay">
        <h2>{{trans('static.edit_static_page_title')}}</h2>
    </div>
</div>
<!--Header END-->

<div class="content"><!--Content Starts-->

    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">

                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    @if( ! empty(\Auth::id()) && \Session::get('user_type') == \Config::get('constants.USER_ROLE_ADMIN'))
                    <p>
                        <form action="{{ url('/approve-static-page') }}" method="post">
                            <fieldset>
                                {{trans('static.current_status')}}: 
                                <span> 
                                    @if($cm_static_page->status == \Config::get('constants.PAGE_STATUS_DRAFT'))
                                        <span>{{trans('common.page_status_draft')}}</span>
                                    @else
                                        <span class="blue">{{trans('common.page_status_public')}}</span>
                                    @endif
                                </span>
                                {{ csrf_field() }}
                                <input type="hidden" name="cm_static_page_id" value="{{$cm_static_page->id}}"/>
                                <select name="status" required>
                                    <option value=""> {{trans('static.select_status')}}</option>
                                    <option value="{{\Config::get('constants.PAGE_STATUS_DRAFT')}}"> {{trans('common.page_status_draft')}}</option>
                                    <option value="{{\Config::get('constants.PAGE_STATUS_PUBLIC')}}"> {{trans('common.page_status_public')}}</option>
                                </select>
                                <input type="submit" value="{{trans('static.btn_approve')}}" />
                            </fieldset>
                        </form>
                    </p>
                    @endif

                    <form action="{{ url('/edit-static-page') }}" method="post" class="form-horizontal">
                        <fieldset>
                            <h4>{{trans('static.add_static_page_subtitle')}}</h4>
                            {{ csrf_field() }}
                            <input type="hidden" name="cm_static_page_id" value="{{$cm_static_page->id}}"/>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <?php 
                                    if($cm_static_page->hasTranslation(\Session::get('language')))
                                    {
                                        $page_topic = $cm_static_page->getTranslation(\Session::get('language'))->topic;
                                        $page_content = $cm_static_page->getTranslation(\Session::get('language'))->content;
                                    }
                                    else
                                    {
                                        $page_topic = '';
                                        $page_content = '';
                                    }
                                    ?>
                                    <label for="topic">{{trans('static.topic')}}<span class="red">*</span>:</label>
                                    <input type="text" name="topic" id="topic" required placeholder="{{trans('static.no_tranlation')}}*" value="{{$page_topic}}">
                                </div>
                            </div> 

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="content">{{trans('static.content')}}<span class="red">*</span>:</label>
                                    <textarea name="content" id="content" placeholder="{{trans('static.no_tranlation')}}*" onFocus="focusLink(true)" onBlur="focusLink(false)" required>{{$page_content}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="html_class">{{trans('static.html_class')}}:</label>
                                    <input type="text" name="html_class" id="html_class" placeholder="{{trans('static.html_class')}}" value="{{$cm_static_page->html_class}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="checkbox col-sm-6">
                                    <?php
                                    if( $cm_static_page->is_in_main_menu)
                                    {
                                        $checked = 'checked';
                                    }else{
                                        $checked = '';
                                    }
                                    ?>
                                    <input type="checkbox" name="is_in_main_menu" id="is_in_main_menu" value="1" {{$checked}}>
                                    <label for="is_in_main_menu">{{trans('static.is_in_main_menu')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="checkbox col-sm-6">
                                    <?php
                                    if( $cm_static_page->is_in_footer)
                                    {
                                        $checked = 'checked';
                                    }else{
                                        $checked = '';
                                    }
                                    ?>
                                    <input type="checkbox" name="is_in_footer" id="is_in_footer" value="1" {{$checked}}>
                                    <label for="is_in_footer">{{trans('static.is_in_footer')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="checkbox col-sm-6">
                                    <?php
                                    if( $cm_static_page->is_in_unauth)
                                    {
                                        $checked = 'checked';
                                    }else{
                                        $checked = '';
                                    }
                                    ?>
                                    <input type="checkbox" name="is_in_unauth" id="is_in_unauth" value="1" {{$checked}}>
                                    <label for="is_in_unauth">{{trans('static.is_in_unauth')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="checkbox col-sm-6">
                                    <?php
                                        if( $cm_static_page->is_home_slider)
                                        {
                                            $checked = 'checked';
                                        }else{
                                            $checked = '';
                                        }
                                    ?>
                                    <input type="checkbox" name="is_home_slider" id="is_home_slider" value="1" {{$checked}}>
                                    <label for="is_home_slider">{{trans('static.is_home_slider')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="{{trans('common.btn_save')}}">
                            </div>
                        </fieldset>
                    </form>
                </div>

                

                @endsection



