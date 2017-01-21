@extends('layouts.dashboard')

@section('content')
<script type="text/javascript">
var base_url = {!! json_encode(url('/')) !!};
var user_id = {!! json_encode(\Auth::id()) !!};
function save_rating(rating) {
    if( ! user_id)
    {
        alert('Трябва да влезете в системата, за да може да гласувате!');
    }else{

        var csrf_field = $('#csrf_token').val();
        var article_id = $('#article_id').val();
        $.ajax({
            type: "POST",
            url: base_url + '/article-rating',
            data: {cm_article_id: article_id, rating: rating, _token: csrf_field},
            success: function( msg ) {
                $("#ajaxResponse").append("<div>"+msg+"</div>");
            }
        });
    }
    
}
</script>

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
                        <input type="hidden" name="_token" id="csrf_token" value="{{csrf_token()}}">
                        <input type="hidden" name="article_id" id="article_id" value="{{$cm_article->id}}"/>
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

        @if($cm_article->status == \Config::get('constants.ARTICLE_WAITING_APPROVAL') && \Auth::id() != $cm_article->created_by)
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
            @if(($cm_article->status == \Config::get('constants.ARTICLE_PRIVATE')) && empty(\Auth::id()))
                {!! substr($cm_article->getTranslation(\Session::get('language'))->content, 0, 100) !!}...
                <div class="article-warning">Тази статия е достъпна само за регистрирани потребители. За да прочетете пълния текст трябва да влезете в профила си.</div>
                <div class="next"><a href="{{url('/login')}}"><input type="submit" name="login" value="{{trans('common.btn_go_to_login')}}"></a></div>
            @else
                {!! $cm_article->getTranslation(\Session::get('language'))->content !!}
            @endif
        @else
        {{trans('common.no_translation')}}
        @endif
        

        <div class="rate-form">
            <fieldset class="rating">
                <?php
                    if( count($cm_article->cmArticleRatings) > 0)
                    {
                        $checked_rating = $cm_article->cmArticleRatings[0]->rating;
                    }else{
                        $checked_rating = 0;
                    }
                ?>
                <legend>{{trans('articles.rate_article')}}: </legend>
                <!-- If the user has no right to change the status we add the hidden fileds here -->
                <input type="hidden" name="_token" id="csrf_token" value="{{csrf_token()}}">
                <input type="hidden" name="article_id" id="article_id" value="{{$cm_article->id}}"/>
                <input type="radio" id="4star5" name="rating4" value="5" onclick="save_rating(5)" {{ ($checked_rating == 5) ? 'checked' : ''}}><label for="4star5" title="Отлично">Отлично</label>
                <input type="radio" id="4star4" name="rating4" value="4" onclick="save_rating(4)" {{ ($checked_rating == 4) ? 'checked' : ''}}><label for="4star4" title="Много добро">Много добро</label>
                <input type="radio" id="4star3" name="rating4" value="3" onclick="save_rating(3)" {{ ($checked_rating == 3) ? 'checked' : ''}}><label for="4star3" title="Добро">Добро</label>
                <input type="radio" id="4star2" name="rating4" value="2" onclick="save_rating(2)" {{ ($checked_rating == 2) ? 'checked' : ''}}><label for="4star2" title="Средно">Средно</label>
                <input type="radio" id="4star1" name="rating4" value="1" onclick="save_rating(1)" {{ ($checked_rating == 1) ? 'checked' : ''}}><label for="4star1" title="Слабо">Слабо</label>
            </fieldset>
            <span id="ajaxResponse"></span>
        </div>

        <div class="rate-form">
            <fieldset class="rating">
                <?php
                    if( count($average_ratings) > 0)
                    {
                        $avg_rating = $average_ratings->avg('rating');
                        $checked_rating = (int)$avg_rating;
                    }else
                    {
                        $avg_rating = 'Няма оценки';
                        $checked_rating = 0;
                    }
                ?>
                <legend>{{trans('articles.average_rating')}}: {{$avg_rating}}</legend>
            </fieldset>
        </div>
        @endif
    </article>

    <hr>
<div class="article-navigation">
 <div class="back"><a href="<?php echo url('articles'); ?>">{{trans('articles.btn_to_all_articles')}}</a></div>
</div><!--Content Ends-->

@endsection