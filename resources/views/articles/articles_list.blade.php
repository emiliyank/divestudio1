@extends('layouts.dashboard')

@section('content')

<div class="header small">
	<div class="overlay">
    	<h2>{{trans('articles.articles_list_title')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->

<section>
	<div class="container">
    <div>
        <div class="article-filter center">
        	<p><a href="#">Всички статии</a> 
                @foreach($cl_article_types as $cm_article_type)
                    <a href="#">{{$cm_article_type->getTranslation(\Session::get('language'))->article_type}}</a>
                @endforeach
            </p>
		</div>
        
    	<div class="boxes boxes-articles">
        
        @foreach($cm_articles as $cm_article)
        	<div class="box article-data">
            	<a href=<?php echo url("/single-article/$cm_article->id"); ?>>
                	<div class="image-wrap">
                    	<img src=<?php echo asset("images/upload/thumbnails/$cm_article->picture_thumb"); ?> alt="Article thumb image">
                    </div>
                    <div class="rate-form">
                    <fieldset class="rating">
                        <input type="radio" id="1star5" name="rating1" value="5" checked><label for="1star5" title="Отлично">Отлично</label>
                        <input type="radio" id="1star4" name="rating1" value="4"><label for="1star4" title="Много добро">Много добро</label>
                        <input type="radio" id="1star3" name="rating1" value="3"><label for="1star3" title="Добро">Добро</label>
                        <input type="radio" id="1star2" name="rating1" value="2"><label for="1star2" title="Средно">Средно</label>
                        <input type="radio" id="1star1" name="rating1" value="1"><label for="1star1" title="Слабо">Слабо</label>
                    </fieldset>
                    </div>
                    <h2>
                        @if($cm_article->hasTranslation(\Session::get('language')))
                        {{$cm_article->getTranslation(\Session::get('language'))->topic}}
                        @else
                        {{trans('common.no_translation')}}
                        @endif
                    </h2>
                    <p class="date">{{$cm_article->date_approved}}</p>
                    <p class="author">{{trans('common.published_by')}} <strong>{{$cm_article->createdBy['org_name']}}</strong></p>
                    <p class="status"> {{trans('articles.status')}} 
                            @if($cm_article->status == \Config::get('constants.ARTICLE_PRIVATE'))
                                <span class="status-private">
                                {{trans('articles.private_article')}}
                            @elseif($cm_article->status == \Config::get('constants.ARTICLE_PUBLIC'))
                                <span class="status-public">
                                {{trans('articles.public_article')}}
                            @else
                                <span>
                                {{trans('articles.waiting_approval_status')}}
                            @endif
                        </span>
                    </p>
                    <span class="tags">
                        {{$cm_article->clArticleType->getTranslation(\Session::get('language'))->article_type}}
                    </span>
                    <p>
                        @if($cm_article->hasTranslation(\Session::get('language')))
                        <div>
                            {{ substr($cm_article->getTranslation(\Session::get('language'))->content, 0, 100)}} [...]
                        </div>
                        @else
                            {{trans('common.no_translation')}}
                        @endif
                    </p>
                </a>
            </div>
        @endforeach
        </div>

@endsection