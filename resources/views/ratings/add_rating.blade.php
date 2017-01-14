@extends('layouts.app')

@section('content')
    <h1> {{trans('ratings.add_rating_title')}} </h1>

    <div class="container">
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.title')}}</label>
            <div class="col-sm-6">
                {{$cm_ad->getTranslation(\Session::get('language'))->title}}
            </div>
        </div><br/><br/>        
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.content')}}</label>
            <div class="col-sm-6">
               {{$cm_ad->content}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.deadline')}}</label>
            <div class="col-sm-6">
                {{$cm_ad->deadline}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.budget')}}</label>
            <div class="col-sm-6">
                {{$cm_ad->budget}}
            </div>
        </div>
    </div>
    @if($cm_ad->date_accepted)
        <div class="container">
            <h4> 
                {{trans('offers.offer_title')}}
                This add is already approved on {{$cm_ad->date_accepted}}. You cannot place offer. 
            </h4>
        </div>
    @else
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif
    {!! Form::open(array('route' => 'route.add_rating', 'method' => 'post', 'class' => 'form-horizontal')) !!}
<?php
    echo Form::hidden('cm_ad_id', $cm_ad->id, array('class' => 'form-control'));
    echo Form::hidden('cm_offer_id', $cm_offer->id, array('class' => 'form-control'));
    echo Form::hidden('user_graded_id', $cm_offer->created_by, array('class' => 'form-control'));

    $grades_list = array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5');

    echo '<div class="row">';
    echo '<div class="form-group col-md-9 col-md-push-1">';
        echo Form::label('grade', trans('ratings.grade'));
        echo Form::select('grade', $grades_list, null, ['placeholder' => trans('ratings.grade_placeholder'), 'class' => 'form-control']);
    echo '</div> </div>';

    echo '<div class="row">';
    echo '<div class="form-group col-md-9 col-md-push-1">';
        echo Form::label('comment', trans('offers.comment'));
        echo Form::textarea ('comment', e(old('comment')), array('class' => 'form-control'));
    echo '</div> </div>';

    echo Form::submit(trans('common.btn_add'), array('class' => 'btn btn-primary pull-right'));
?>
    {!! Form::close() !!}
    @endif
    <?php
        echo link_to_route('route.ads_list', $title = trans('common.btn_cancel'), $parameters = null, $attributes = array('class' =>"btn btn-default pull-right"));
    ?>
@endsection
