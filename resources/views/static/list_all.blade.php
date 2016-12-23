@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>Статични страници</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->

    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">
                <a href="{{url('/add-static-page/')}}">
                    <input type="submit" value="{{trans('static.btn_add_page')}}">
                </a>
                @foreach($static_pages as $static_page)
                    <div class="user-box archive announcement">
                            <div class="container">
                                <p class="big">{{trans('static.list_page_title')}}: 
                                    <strong>
                                    @if($static_page->getTranslation(\Session::get('language')))
                                        {{$static_page->getTranslation(\Session::get('language'))->topic}}
                                    @else
                                        id: {{$static_page->id}} {{trans('common.no_translation')}}
                                    @endif
                                    </strong>
                                </p>
                                <p>{{trans('static.list_page_created_by')}}: <span class="blue">{{$static_page->createdBy->getTranslation(\Session::get('language'))->name}}</span></p>
                                <p>{{trans('static.list_page_created_at')}}: <strong>{{$static_page->created_at}}</strong></p>
                                <p><a href='{{url("/static-page/$static_page->id")}}'> {{trans('static.view_page_link')}}</a></p>
                                <p><a href='{{url("/edit-static-page/$static_page->id")}}'> {{trans('static.edit_page_link')}}</a></p>
                                <p><a href='{{url("/delete-static-page/$static_page->id")}}' data-method="delete" data-token="{{ csrf_token()}}" onclick="return confirm('{{trans('common.validate_page_deletion')}}');"> {{trans('static.delete_page_link')}}</a></p>
                            </div>
                    </div>
                @endforeach
                </div>
@endsection

