@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>Нова обява</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->

<section class="profile">
    <div class="container">
        <div class="boxes layout-left">
        <div class="box">

            <!-- New Ad Form -->
            <form action="{{ url('ad') }}" method="POST" class="form-horizontal">
            <fieldset>
                {{ csrf_field() }}

                <h4>Нова обява</h4>
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <div class="col-sm-6">
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="{{trans('ads.placeholder_title')}}">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('service_id') ? ' has-error' : '' }}">
                    <div class="col-md-6">
                        <select id="service_id" class="form-control" name="service_id" placeholder="{{trans('ads.placeholder_service')}}">
                            <option value="">{{trans('ads.placeholder_service')}} </option>
                            @foreach($cl_services as $service)
                                <option value="{{$service->id}}" {{(old('service_id') == $service->id) ? "selected":""}}>{{$service->getTranslation(\Session::get('language'))->service}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('service_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('service_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <div class="col-md-6">
                        <textarea id="content" class="form-control" name="content" placeholder="{{trans('ads.placeholder_content')}}">{{old('content')}}</textarea>
                        @if ($errors->has('content'))
                            <span class="help-block">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <p>Бюджет на услугата:</p>
                <hr>

                <div class="form-group{{ $errors->has('budget') ? ' has-error' : '' }}">
                    <div class="col-sm-6">
                        <input type="number" min="0" name="budget" id="budget" class="budget" value="{{ old('budget') }}" placeholder="{{trans('ads.placeholder_budget')}}">
                        @if ($errors->has('budget'))
                            <span class="help-block">
                                <strong>{{ $errors->first('budget') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <p>Да се търси изпълнител в:</p>
                <hr>
                <p style="font-size: 26px;"><a href="javascript:void(0)" onclick="$('.checkboxes-group :checkbox').prop('checked', true); $(this).blur()"><i class="fa fa-check-square"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="javascript:void(0)" onclick="$('.checkboxes-group :checkbox').prop('checked', false); $(this).blur()"><i class="fa fa-square"></i></a></p>
                <div class="checkboxes-group">
                     @foreach($cl_regions as $region)
                        <?php
                            $selected = '';
                            if(old('regions') && array_key_exists($region->id, old('regions')))
                            {
                                $selected = 'checked';
                            }
                        ?>
                        <input type="checkbox" name="regions[{{$region->id}}]" id="regions[{{$region->id}}]" value="{{$region->id}}" {{$selected}} ><label for="regions[{{$region->id}}]">{{$region->getTranslation(\Session::get('language'))->region}}</label><br>
                    @endforeach
                </div>

                <div class="form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">
                    <div class="datepicker-wrapper">
                        <script>
                            
                        </script>
                        <label for="date">Крайна дата за получаване на оферти:</label>
                        <input type="text" name="deadline" id="deadline" class="date-picker" value="{{ old('deadline') }}" placeholder="{{trans('ads.placeholder_deadline')}}">
                        @if ($errors->has('deadline'))
                            <span class="help-block">
                                <strong>{{ $errors->first('deadline') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <hr>
                <div class="checkbox">
                    <input type="checkbox" name="supply-agreement" id="supply-agreement" required value="Agreed with Ptivacy Policy" {{(old('supply-agreement') == 'Agreed with Ptivacy Policy') ? "checked":""}}>
                    <label for="supply-agreement">Прочел съм и съм съгласен с <a href="#" target="_blank">Общите условия</a><span class="red">*</span></label>
                </div>                

                <div class="form-group">
                    <input type="submit" value="Публикувай">
                </div>
            </fieldset>
            </form>
        </div>

@endsection



