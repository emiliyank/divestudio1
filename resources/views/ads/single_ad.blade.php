@extends('layouts.app')

@section('content')
    @if (session('rating_ad_privillege'))
        <h3 class="alert alert-danger">
            {{ session('rating_ad_privillege') }}
        </h3>
    @endif

    @if (session('rating_ad_expired'))
        <h3 class="alert alert-danger">
            {{ session('rating_ad_expired') }}
        </h3>
    @endif
    <div class="container">
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Title</label>
            <div class="col-sm-6">
                <div class="form-control">{{$ad->title}}</div>
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Service</label>
            <div class="col-sm-6">
                <div class="form-control">{{$service->service_en}}</div>
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Region</label>
            <div class="col-sm-6">
                <div class="form-control">{{$region->region_en}}</div>
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Content</label>
            <div class="col-sm-6">
                <div class="form-control">{{$ad->content}}</div>
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Deadline</label>
            <div class="col-sm-6">
                <div class="form-control">{{$ad->deadline}}</div>
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Budget</label>
            <div class="col-sm-6">
                <div class="form-control">{{$ad->budget}}</div>
            </div>
        </div>
    </div>
@endsection

