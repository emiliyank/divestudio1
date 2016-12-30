@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('static.add_static_page_title')}}</h2>
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

                    <form action="{{ url('/add-static-page') }}" method="post" class="form-horizontal">
                        <fieldset>
                            <h4>{{trans('static.add_static_page_subtitle')}}</h4>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="topic">{{trans('static.topic')}}<span class="red">*</span>:</label>
                                    <input type="text" name="topic" id="topic" required placeholder="{{trans('static.topic')}}*" value="{{old('topic')}}">
                                </div>
                            </div> 

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="content">{{trans('static.content')}}<span class="red">*</span>:</label>
                                    <textarea name="content" id="content" placeholder="{{trans('static.content')}}*" onFocus="focusLink(true)" onBlur="focusLink(false)" required>{{old('content')}}</textarea>
                                </div>
                            </div>
                            <p></p>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="html_class">{{trans('static.html_class')}}:</label>
                                    <input type="text" name="html_class" id="html_class" placeholder="{{trans('static.html_class')}}" value="{{old('html_class')}}">
                                </div>
                            </div> 

                            <div class="form-group">
                                <div class="checkbox col-sm-6">
                                    <?php
                                        if( ! empty(old('is_in_main_menu')))
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
                                        if( ! empty(old('is_in_footer')))
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
                                        if( ! empty(old('is_in_unauth')))
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
                                        if( ! empty(old('is_home_slider')))
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

                <script>
                CKEDITOR.replace( 'content' );
                </script>

                @endsection



