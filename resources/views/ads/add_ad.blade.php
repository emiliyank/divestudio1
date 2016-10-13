@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Ad
                </div>

                <div class="panel-body">

                    <!-- New Ad Form -->
                    <form action="{{ url('ad') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-6">
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('service_id') ? ' has-error' : '' }}">
                            <label for="service_id" class="col-md-3 control-label">Service</label>
                            <div class="col-md-6">
                                <select id="service_id" class="form-control" name="service_id">
                                    <option value=""> </option>
                                    @foreach($cl_services as $id => $service)
                                        <option value={{$service->id}} {{(old('service_id') == $id) ? "selected":""}}>{{$service->service_en}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('service_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('service_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cl_region_id') ? ' has-error' : '' }}">
                            <label for="cl_region_id" class="col-md-3 control-label">Region</label>
                            <div class="col-md-6">
                                <select id="cl_region_id" class="form-control" name="cl_region_id">
                                    <option value=""> </option>
                                    @foreach($cl_regions as $id => $region)
                                        <option value={{$region->id}} {{(old('cl_region_id') == $id) ? "selected":""}}>{{$region->region_en}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('cl_region_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cl_region_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-3 control-label">Content</label>
                            <div class="col-md-6">
                                <textarea id="content" class="form-control" name="content">{{old('content')}}</textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">
                            <label for="deadline" class="col-sm-3 control-label">Deadline</label>
                            <div class="col-sm-6">
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type="text" name="deadline" id="deadline" class="form-control" value="{{ old('deadline') }}">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                @if ($errors->has('deadline'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('deadline') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('budget') ? ' has-error' : '' }}">
                            <label for="budget" class="col-sm-3 control-label">Budget</label>
                            <div class="col-sm-6">
                                <input type="text" name="budget" id="budget" class="form-control" value="{{ old('budget') }}">
                                @if ($errors->has('budget'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('budget') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Ad
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


