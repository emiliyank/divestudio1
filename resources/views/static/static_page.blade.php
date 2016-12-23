@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header article-header">
    <div class="overlay">
     <h2>
        @if($cm_static_page->hasTranslation(\Session::get('language')))
        {{$cm_static_page->getTranslation(\Session::get('language'))->topic}}
        @else
        {{trans('common.no_translation')}}
        @endif
    </h2>
</div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->
    <section>
     <div class="container">
        <article>
        @if($cm_static_page->hasTranslation(\Session::get('language')))
                {!! $cm_static_page->getTranslation(\Session::get('language'))->content !!}
        @else
        {{trans('common.no_translation')}}
        @endif
    </article>
@endsection