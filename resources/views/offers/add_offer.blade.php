@extends('layouts.app')

@section('content')
    <h1> Offer </h1>

    <div class="container">
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Title</label>
            <div class="col-sm-6">
                {{$cm_ad->title}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Service</label>
            <div class="col-sm-6">
                {{$service->service_en}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Region</label>
            <div class="col-sm-6">
                {{$region->region_en}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Content</label>
            <div class="col-sm-6">
               {{$cm_ad->content}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Deadline</label>
            <div class="col-sm-6">
                {{$cm_ad->deadline}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Budget</label>
            <div class="col-sm-6">
                {{$cm_ad->budget}}
            </div>
        </div>
    </div>
    @if($cm_ad->date_accepted)
        <div class="container">
            <h4> This add is already approved on {{$cm_ad->date_accepted}}. You cannot place offer. </h4>
        </div>
    @else
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif
    {!! Form::open(array('url' => 'offer', 'method' => 'post', 'class' => 'form-horizontal')) !!}
<?php
    echo Form::hidden('cm_ad_id', $cm_ad->id, array('class' => 'form-control'));

    echo '<div class="row">';
    echo '<div class="form-group col-md-9 col-md-push-1">';
        echo Form::label('price', trans('offer.price'));
        echo Form::text('price', e(old('price')), array('class' => 'form-control'));
    echo '</div> </div>';

    echo '<div class="row">';
    echo '<div class="form-group col-md-9 col-md-push-1">';
        echo Form::label('comment', trans('offer.comment'));
        echo Form::textarea ('comment', e(old('comment')), array('class' => 'form-control'));
    echo '</div> </div>';

    echo '<div class="row">';
    echo '<div class="form-group col-md-9 col-md-push-1" id="datetimepicker1">';
        echo Form::label('deadline', trans('offer.deadline'));
        echo Form::text('deadline', e(old('deadline')), array('class' => 'form-control'));
    echo '</div> </div>';

    echo Form::submit(trans('offer.add_offer'), array('class' => 'btn btn-primary pull-right'));
?>
    {!! Form::close() !!}
    @endif
    <?php
        echo link_to_route('route.ads_list', $title = 'Cancel', $parameters = null, $attributes = array('class' =>"btn btn-default pull-right", 'title' => 'Cancel'));
    ?>
@endsection
