@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header article-header" style="background-image:url({{asset('/design/img/icon/demo_pic_01_large.png')}});">
    <div class="overlay">
     <h2>
        @if($cm_article->hasTranslation(\Session::get('language')))
        {{$cm_article->getTranslation(\Session::get('language'))->topic}}
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
        @if( ! empty(\Auth::id()) && \Session::get('user_type') == \Config::get('constants.USER_ROLE_ADMIN'))
            <p>
                <form action="{{ url('/approve-article') }}" method="post">
                    <fieldset>
                        {{ csrf_field() }}
                        <input type="hidden" name="article_id" value="{{$cm_article->id}}"/>
                        <select name="status" required>
                            <option value=""> {{trans('articles.select_status')}}</option>
                            <option value="{{\Config::get('constants.ARTICLE_PRIVATE')}}"> {{trans('articles.private_article')}}</option>
                            <option value="{{\Config::get('constants.ARTICLE_PUBLIC')}}"> {{trans('articles.public_article')}}</option>
                        </select>
                        <input type="submit" value="{{trans('articles.btn_approve')}}" />
                    </fieldset>
                </form>
            </p>
        @endif

        @if($cm_article->status === \Config::get('constants.ARTICLE_WAITING_APPROVAL') && \Auth::id() != $cm_article->created_by)
        <span>
            {{trans('articles.waiting_approval_status')}}
        </span>
        @else
        <div class="article-data center">
            <p>{{trans('common.created_at')}} <span class="date">{{$cm_article->created_at}}</span> 
                {{trans('common.published_by')}} <span class="author">{{$cm_article->createdBy['org_name']}}</span> 
                {{trans('articles.category')}} <span class="tags">{{$cm_article->clArticleType->getTranslation(\Session::get('language'))->article_type}}</span> 
                {{trans('articles.status')}} 
                
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
        </div>
        
        <div class="advertising">
            <div class="desktop"><a href="http://www.dive-accounting.com" target="_blank"><img src="{{asset('design/img/pic/banners/720x90.jpg')}}" alt="Advertisement"></a></div>
            <div class="mobile"><a href="http://www.dive-accounting.com" target="_blank"><img src="{{asset('design/img/pic/banners/300x250.jpg')}}" alt="Advertisement"></a></div>
        </div>
        
        <article>
         @if($cm_article->hasTranslation(\Session::get('language')))
            @if(($cm_article->status === \Config::get('constants.ARTICLE_PRIVATE')) && empty(\Auth::id()))
                {!! substr($cm_article->getTranslation(\Session::get('language'))->content, 0, 100) !!}...
                <div class="next"><a href="{{url('/login')}}">{{trans('common.btn_go_to_login')}}</a></div>
            @else
                {!! $cm_article->getTranslation(\Session::get('language'))->content !!}
            @endif
        @else
        {{trans('common.no_translation')}}
        @endif
        
        <div class="rate-form">
            <fieldset class="rating">
                <legend>{{trans('articles.rate_article')}}</legend>
                <input type="radio" id="4star5" name="rating4" value="5"><label for="4star5" title="Отлично">Отлично</label>
                <input type="radio" id="4star4" name="rating4" value="4"><label for="4star4" title="Много добро">Много добро</label>
                <input type="radio" id="4star3" name="rating4" value="3"><label for="4star3" title="Добро">Добро</label>
                <input type="radio" id="4star2" name="rating4" value="2" checked><label for="4star2" title="Средно">Средно</label>
                <input type="radio" id="4star1" name="rating4" value="1"><label for="4star1" title="Слабо">Слабо</label>
            </fieldset>
        </div>
        @endif
    </article>

    <hr>
    <h3>{{trans('articles.similar_articles')}}</h3>
    <div class="boxes boxes-articles">

     <div class="box">
         <a href="#">
             <div class="image-wrap">
                 <img src="img/pic/demo_pic_01.jpg" alt="">
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
            <h2>Кога се подава декларация по чл.55?</h2>
            <p class="date">01.12.2016</p>
            <p class="author">Публикувана от: <strong>Бетон Интелект ООД</strong></p>
            <p class="status">Статут: <span class="public">Видима за всички</span></p>
            <p class="tags"><span>Данъци</span><span>Декларации</span></p>
            <p>Според ЗДДФЛ чл.55, ал.1 обект на деклариране от юридическите лица и самоосигуряващите се лица – платци на доходи, са: 1. Дължимите окончателни данъци в полза на чуждестранни физически лица по реда на чл. 37 и чл.38 от ЗДДФЛ; 2. Окончателните данъци, дължими върху доходи на местни лица по реда на чл.38 от ЗДДФЛ, като доходи от: дивиденти и ликвидационни дялове, [...]</p>
        </a>
    </div>

    <div class="box">
     <a href="#">
         <div class="image-wrap">
             <img src="img/pic/demo_pic_03.jpg" alt="">
         </div>
         <div class="rate-form">
            <fieldset class="rating">
                <input type="radio" id="2star5" name="rating2" value="5"><label for="2star5" title="Отлично">Отлично</label>
                <input type="radio" id="2star4" name="rating2" value="4" checked><label for="2star4" title="Много добро">Много добро</label>
                <input type="radio" id="2star3" name="rating2" value="3"><label for="2star3" title="Добро">Добро</label>
                <input type="radio" id="2star2" name="rating2" value="2"><label for="2star2" title="Средно">Средно</label>
                <input type="radio" id="2star1" name="rating2" value="1"><label for="2star1" title="Слабо">Слабо</label>
            </fieldset>
        </div>
        <h2>Касова отчетност на ДДС</h2>
        <p class="date">01.12.2016</p>
        <p class="author">Публикувана от: <strong>Бетон Интелект ООД</strong></p>
        <p class="status">Статут: <span class="public">Видима за всички</span></p>
        <p class="tags"><span>Данъци</span></p>
        <p>Специалният режим  за касова отчетност на данък  върху  добавената стойност има за цел  да подпомогне регистрирани по Закона за данък  върху добавената стойност (ЗДДС) лица с облагаем оборот до 500 000 евро. Какво предимство дава касовата отчетност на ДДС? Същността на този специален режим се състои в това, че ДДС за доставка става изискуем  на датата на получаване на цялостно или частично плащане по доставката. [...]</p>
    </a>
</div>

<div class="box">
 <a href="#">
     <div class="image-wrap">
         <img src="img/pic/demo_pic_01.jpg" alt="">
     </div>
     <div class="rate-form">
        <fieldset class="rating">
            <input type="radio" id="3star5" name="rating3" value="5"><label for="3star5" title="Отлично">Отлично</label>
            <input type="radio" id="3star4" name="rating3" value="4"><label for="3star4" title="Много добро">Много добро</label>
            <input type="radio" id="3star3" name="rating3" value="3"><label for="3star3" title="Добро">Добро</label>
            <input type="radio" id="3star2" name="rating3" value="2" checked><label for="3star2" title="Средно">Средно</label>
            <input type="radio" id="3star1" name="rating3" value="1"><label for="3star1" title="Слабо">Слабо</label>
        </fieldset>
    </div>
    <h2>Възстановяване на ДДС от държави-членки на ЕС</h2>
    <p class="date">01.12.2016</p>
    <p class="author">Публикувана от: <strong>Бетон Интелект ООД</strong></p>
    <p class="status">Статут: <span class="private">Само за регистрирани потребители</span></p>
    <p class="tags"><span>Декларации</span></p>
    <p>Данъчно задължено лице,  установено на територията на страната, което иска да му бъде възстановен данък върху добавената стойност от друга държава членка на Общността, начислен му за закупени от него стоки, получени услуги или осъществен внос на територията на същата, следва да отговаря на условията, предвидени в  държавата членка по възстановяване. Правата и ограниченията на лицата и периодите за упражняване [...]</p>
</a>
</div>

</div>

<div class="article-navigation">
 <div class="back"><a href="<?php echo url('articles'); ?>">{{trans('articles.btn_to_all_articles')}}</a></div>
</div><!--Content Ends-->

@endsection