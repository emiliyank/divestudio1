@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>Получение предложения</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->

    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">
                    @if(count($received_offers) > 0)
                    <div class="article-filter center">
                        <?php
                            $new_date_order = 'desc';
                            if($date_order == 'asc')
                            {
                                $current_date_order_text = '(' . trans('offers.ordered_asc') . ')';
                            }
                            elseif($date_order == 'desc')
                            {
                                $new_date_order = 'asc';
                                $current_date_order_text = '(' . trans('offers.ordered_desc') . ')';
                            }
                            else
                            {
                                $current_date_order_text = '';
                            }

                            $new_price_order = 'desc';
                            if($price_order == 'asc')
                            {
                                $current_price_order_text = '(' . trans('offers.ordered_asc') . ')';
                            }
                            elseif($price_order == 'desc')
                            {
                                $new_price_order = 'asc';
                                $current_price_order_text = '(' . trans('offers.ordered_desc') . ')';
                            }
                            else
                            {
                                $current_price_order_text = '';
                            }
                        ?>
                        <p>
                            <a href="{{url('/user-offers/')}}">{{trans('offers.order_default')}}</a>
                            <a href='{{url("/user-offers?date=$new_date_order")}}'>{{trans('offers.order_by_date')}} {{$current_date_order_text}}</a>
                            <a href='{{url("/user-offers?price=$new_price_order")}}'>{{trans('offers.order_by_price')}} {{$current_price_order_text}}</a>
                        </p>
                    </div>
                @foreach($received_offers as $offer)
                    <div class="user-box archive announcement">
                            <div class="container">
                                <p class="big">
                                    <a href='{{url("show_ad/$offer->cm_ad_id")}}'>
                                        @if($offer->cmAd->getTranslation(\Session::get('language')))
                                            {{$offer->cmAd->getTranslation(\Session::get('language'))->title}}
                                        @else
                                            id: [{{$offer->cmAd->id}}] {{trans('common.no_translation')}}
                                        @endif
                                    </a>
                                </p>
                                <p>{{trans('offers.comment')}}: {{$offer->comment}}</p>
                                <p>{{trans('offers.price')}}: <strong>{{$offer->price}}</strong></p>
                                <p>{{trans('common.created_by')}}: 
                                    <span class="blue">
                                        <a href='{{url("/view-profile/$offer->created_by")}}' target="_blank">
                                            @if($offer->createdBy->hasTranslation(\Session::get('language')))
                                                {{$offer->createdBy->getTranslation(\Session::get('language'))->org_name}}  
                                            @else
                                                id: [{{$offer->createdBy->id}}] {{trans('common.no_translation')}}
                                            @endif
                                            &lt;{{$offer->createdBy->email}}&gt;

                                            <?php
                                            $ratings_count = count($offer->createdBy->cmRatings);
                                            if( $ratings_count > 0)
                                            {
                                                $avg_rating = $offer->createdBy->cmRatings->avg('rating');
                                            }else
                                            {
                                                $avg_rating = 'Няма оценки';
                                            }

                                            $articles_count = count($offer->createdBy->cmArticles);
                                            ?>
                                            {{trans('common.average_rating')}}: {{$avg_rating}}
                                            {{trans('common.articles_count')}}: {{$articles_count}}
                                        </a>
                                    </span>
                                </p>
                                <p>{{trans('common.created_at')}}: <strong>{{$offer->created_at}}</strong></p>
                                
                            </div>
                    </div>
                @endforeach

                @else
                <div id="warning">
                    <p>{{trans('offers.no_received_offers')}}</p>
                </div>
                @endif
                </div>
@endsection

