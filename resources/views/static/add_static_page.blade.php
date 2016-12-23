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



