@extends('layouts.dashboard')

@section('content')
<!--Slider-->
<?php
    //use App\CmStaticPage;
?>
<div class="slider">

    <div class="slide">
        <div class="overlay">
            <div class="slide-left">
                <h2 class="sl-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.5s">Открийте вашия <strong>счетоводител</strong></h2>
                <p class="sl-animation" data-os-animation="fadeInLeft" data-os-animation-delay="1s">Намерете подходящия за вас счетоводител в най-голямата база данни в България</p>
                <p class="sl-animation button" data-os-animation="fadeInLeft" data-os-animation-delay="1.5s"><a href='{{url("static-page/$slider_page_id")}}'>Научете как</a></p>
            </div>
            <div class="slide-right">
               <p class="sl-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.1s"><img src="{{asset('design/img/pic/slide_01.png')}}" alt="Открийте Вашия счетоводител"></p>   
            </div>
        </div>
    </div>   
    <div class="slide">
        <div class="overlay">
            <div class="slide-left">
                <h2 class="sl-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.5s"><strong>Всички</strong> услуги на едно място</h2>
                <p class="sl-animation" data-os-animation="fadeInLeft" data-os-animation-delay="1s">Всичко за Вашето счетоводство на Schetovodno.com - прозрачно и конкурентно</p>
                <p class="sl-animation button" data-os-animation="fadeInLeft" data-os-animation-delay="1.5s"><a href="{{url('static-page/$slider_page_id')}}">Научете как</a></p>
            </div>
            <div class="slide-right">
                <p class="sl-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.1s"><img src="{{asset('/design/img/pic/slide_02.png')}}" alt="Всички услуги на едно място"></p>
            </div>
        </div>
    </div>
    <div class="slide">
        <div class="overlay">
            <div class="slide-left">
                <h2 class="sl-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.5s"><strong>Предложете</strong> счетоводна услуга</h2>
                <p class="sl-animation" data-os-animation="fadeInLeft" data-os-animation-delay="1s">Включете се в Schetovodno.com и предложете услугите си на бъдещите си клиенти</p>
                <p class="sl-animation button" data-os-animation="fadeInLeft" data-os-animation-delay="1.5s"><a href="{{url('static-page/$slider_page_id')}}">Научете как</a></p>
            </div>
            <div class="slide-right">
                <p class="sl-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.1s"><img src="{{asset('/design/img/pic/slide_03.png')}}" alt="Предложи счетоводна услуга"></p>
            </div>
        </div>
    </div>
</div>
<!--Slider END-->

<div class="content"><!--Content Starts-->
	<div class="boxes four-columns">
    	<div class="box box-fit">
        	<h2>По мярка</h2>
            <p>При търсене на услуга вие ще получите само оферти, които отговарят на вашите изисквания и бюджет</p>
        </div>
        <div class="box box-demand">
        	<h2>По поръчка</h2>
            <p>Можете да търсите всякакъв вид счетоводни услуги без значение дали са малки или големи, еднократни или постоянни.</p>
        </div>
        <div class="box box-best">
        	<h2>Най-доброто</h2>
            <p>Сечтоводителите и фирмите, от които ще получавате оферти, са оценявани от своите клиенти - всичко е напълно прозрачно!</p>
        </div>
        <div class="box box-free">
        	<h2>Безплатно</h2>
            <p>Търсенето на услуги и оферти в Счетоводно.com е напълно безплатно! Само трябва да се регистрирате.</p>
        </div>
    </div>
    
<section>
	<div class="container">
    	
        <div class="advertising">
            <div class="desktop"><a href="http://www.dive-accounting.com" target="_blank"><img src="{{asset('/design/img/pic/banners/720x90.jpg')}}" alt="Advertisement"></a></div>
            <div class="mobile"><a href="http://www.dive-accounting.com" target="_blank"><img src="{{asset('/design/img/pic/banners/300x250.jpg')}}" alt="Advertisement"></a></div>
        </div>
        
    	<h1>Последни статии</h1>
    	<div class="boxes boxes-articles">
            @foreach($latest_articles as $cm_article)
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
                        <div class="article-content">
                            {!! $cm_article->getTranslation(\Session::get('language'))->content !!}
                        </div>
                        <div class="ellipsis">[...]</div>
                        @else
                            {{trans('common.no_translation')}}
                        @endif
                    </p>
                </a>
            </div>
            @endforeach
        	
            
@endsection