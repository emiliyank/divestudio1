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
            <p>
                <a href="javascript:void(0)" onclick="show_only(0,'&nbsp;')">Всички статии</a> 
@foreach($cl_article_types as $cm_article_type)
                <a href="javascript:void(0)" onclick="show_only({{$cm_article_type->id}},'{{$cm_article_type->getTranslation(\Session::get('language'))->article_type}}')">{{$cm_article_type->getTranslation(\Session::get('language'))->article_type}}</a>
@endforeach
            </p>
	</div>
        <h2 id="article-filter" class="center">&nbsp;</h2>
    	<div class="boxes boxes-articles">
        
        @foreach($cm_articles as $cm_article)
        	<div class="box article-data" data-type="{{$cm_article->cl_article_type_id}}">
                    <div onclick="window.location.href='{{url("/single-article/$cm_article->id")}}'">
                	<a>
                            <div class="image-wrap">
                                <img src=<?php echo asset("images/upload/thumbnails/$cm_article->picture_thumb"); ?> alt="Article thumb image">
                            </div>
                        </a>
                    <div class="rate-form">
                        <fieldset class="rating">
                             <?php 
                                if( count($cm_article->cmArticleRatings) > 0)
                                {
                                    $avg_rating = $cm_article->cmArticleRatings->avg('rating');
                                    $checked_rating = (int)$avg_rating;
                                }else
                                {
                                    $avg_rating = 'No rating';
                                    $checked_rating = 0;
                                }
                            ?>
                            <input type="radio" name="rating1" {{ ($checked_rating == 5) ? 'checked' : ''}}><label for="1star5" title="Отлично">Отлично</label> 
                            <input type="radio" name="rating1" {{ ($checked_rating == 4) ? 'checked' : ''}}><label for="1star4" title="Много добро">Много добро</label>
                            <input type="radio" name="rating1" {{ ($checked_rating == 3) ? 'checked' : ''}}><label for="1star3" title="Добро">Добро</label>
                            <input type="radio" name="rating1" {{ ($checked_rating == 2) ? 'checked' : ''}}><label for="1star2" title="Средно">Средно</label>
                            <input type="radio" name="rating1" {{ ($checked_rating == 1) ? 'checked' : ''}}><label for="1star1" title="Слабо">Слабо</label>
                        </fieldset>
                       ({{$avg_rating}}), {{$checked_rating}}
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
                        @if($cm_article->hasTranslation(\Session::get('language')))
                        
                        <div class="article-content">
                            {!! $cm_article->getTranslation(\Session::get('language'))->content !!}
<!--                            {!! substr($cm_article->getTranslation(\Session::get('language'))->content, 0, 100) !!} [...]  -->
                        </div>
                        <div class="ellipsis">[...]</div>
                        @else
                            {{trans('common.no_translation')}}
                        @endif
                </div>
            </div>
        @endforeach
        </div>
        <br/><br/>
        <script type="text/javascript">
            function show_only(id,filter){
                $('.article-data').fadeOut();
                $('#article-filter').html(filter);
                if (id==0) { $('.article-data').fadeIn(); }
                else{ $('*[data-type="'+id+'"]').fadeIn(); }
            }
        </script>

@stop