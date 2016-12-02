@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('articles.add_article_title')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->

    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">
                    <h4>{{trans('articles.add_article_subtitle')}}</h4>

                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <form action="{{ url('/add-article') }}" method="post" enctype="multipart/form-data">
                        <fieldset>
                            {{ csrf_field() }}

                            <label for="demand-objectype">{{trans('articles.article_type')}}</label>
                            <select name="cl_article_type_id" id="demand-objectype" required>
                                <option value="">{{trans('articles.article_type_default')}}</option>
                                @foreach($cl_article_types as $article_type)
                                <option value="{{$article_type->id}}">{{$article_type->getTranslation(\Session::get('language'))->article_type}}</option>
                                @endforeach
                            </select>

                            <label for="topic">{{trans('articles.topic')}}<span class="red">*</span>:</label>
                            <input type="text" name="topic" id="topic" required placeholder="{{trans('articles.topic')}}*">

                            <label for="content">{{trans('articles.content')}}<span class="red">*</span>:</label>
                            <textarea name="content" id="content" placeholder="{{trans('articles.content')}}*" onFocus="focusLink(true)" onBlur="focusLink(false)" required></textarea>

                            <label for="picture">{{trans('articles.picture')}}</label>
                            <input type="file" name="picture" id="picture" placeholder="{{trans('articles.picture')}}">

                            <div class="checkbox">
                                <input type="checkbox" name="is_paid" id="is_paid" value="1">
                                <label for="is_paid">{{trans('articles.is_paid')}}</label>
                            </div>

                            <input type="submit" value="{{trans('common.btn_save')}}">
                        </fieldset>
                    </form>

                </div>

                @endsection


