@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('users.details_title')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->

    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">
                    @if (session('updated_data'))
                        <h3 class="alert alert-success">
                            {{ session('updated_data') }}
                        </h3>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
                    <!-- Edit User Details Form -->
                    <form action="{{ url('user-details') }}" method="POST" class="form-horizontal">
                        <fieldset>
                            {{ csrf_field() }}

                            <h4>{{trans('users.details_subtitle')}}</h4>
                            <p>{{trans('users.services_label')}}<br>
                                <em>{{trans('users.services_help_text')}}</em></p>
                                <hr>
                                <?php $i = 0; ?>

                                @foreach($cl_services as $service)
                                <?php
                                $i++;
                                if( ! empty($user_services[$service->id]))
                                {
                                    $selected = 'checked';
                                    $display_budget = '';
                                    $min_budget = $user_services[$service->id];
                                }else{
                                    $selected = '';
                                    $display_budget = 'display: none;';
                                    $min_budget = '';
                                }
                                ?>
                                <div class="checkbox">
                                    <input type="checkbox" name="services[{{$service->id}}]" id="services[{{$service->id}}]" value="{{$service->id}}"  data-related-item="supply-budget{{$service->id}}" {{$selected}}>
                                    <label for="services[{{$service->id}}]">{{$service->getTranslation(\Session::get('language'))->service}}</label>
                                </div>
                                <div style="display: none;">
                                    <label for="supply-budget{{$service->id}}">{{trans('services.minimal_budget')}}</label>
                                    <input type="number" min="0" name="min_budget[{{$service->id}}]" id="supply-budget{{$service->id}}" class="budget" placeholder="{{trans('users.min_budget_placeholder')}}" value="{{$min_budget}}">
                                </div>
                                @endforeach

                                <p>{{trans('users.regions_label')}}</p>
                                <hr>
                                <p style="font-size: 26px;"><a href="javascript:void(0)" onclick="$('.checkboxes-group :checkbox').prop('checked', true); $(this).blur()"><i class="fa fa-check-square"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="javascript:void(0)" onclick="$('.checkboxes-group :checkbox').prop('checked', false); $(this).blur()"><i class="fa fa-square"></i></a></p>
                                    <div class="checkboxes-group">
                                     @foreach($cl_regions as $region)
                                     <?php
                                     $selected = '';
                                     if( ! empty($user_regions[$region->id]))
                                     {
                                        $selected = 'checked';
                                    }
                                    ?>
                                    <input type="checkbox" name="regions[{{$region->id}}]" id="regions[{{$region->id}}]" value="{{$region->id}}" {{$selected}} ><label for="regions[{{$region->id}}]">{{$region->getTranslation(\Session::get('language'))->region}}</label><br>
                                    @endforeach
                                </div>

                                <?php
                                    $selected = '';
                                    if( ! empty($user->is_receiving_emails))
                                    {
                                        $selected = 'checked';
                                    }
                                ?>
                                <div class="checkbox">
                                    <input type="checkbox" name="is_receiving_emails" id="is_receiving_emails" value="1" {{$selected}}>
                                    <label for="is_receiving_emails">{{trans('users.is_receiving_emails')}}</label>
                                </div>

                                <p>{{trans('users.language_label')}}</p>
                                <hr>

                                <?php $i = 0; ?>
                                @foreach($cl_languages as $language)
                                <?php
                                $i++;
                                $selected = '';
                                if( ! empty($user_languages[$language->language]))
                                {
                                    $selected = 'checked';
                                }
                                ?>
                                <div class="checkbox">
                                    <input type="checkbox" name="languages[{{$i}}]" id="languages_{{$i}}" value="{{$language->language}}" {{$selected}}>
                                    <label for="languages_{{$i}}">{{$language->language}}</label>
                                </div>
                                @endforeach

                                <script type="text/javascript">
                                $('#languages_2').change(function() {
                                    $('#supply-english-description-wrapper').slideToggle(200, function() {equalheight('.boxes .box');});
                                });
                                </script>

                                <p>{{trans('users.description_label')}}</p>

                                <label for="description_bg"><span class="red">*</span>:</label>
                                <textarea name="description_bg" id="description_bg" placeholder="{{trans('users.description_bg')}}" onFocus="focusLink(true)" onBlur="focusLink(false)">@if($user->hasTranslation(\Config::get('constants.LANGUAGE_BG'))){{$user->getTranslation(\Config::get('constants.LANGUAGE_BG'))->description}}@endif</textarea>

                                <div id="supply-english-description-wrapper">
                                    <label for="description_en">{{trans('users.description_en')}}<span class="red">*</span>:</label>
                                    <textarea name="description_en" id="description_en" placeholder="{{trans('users.description_en')}}">@if($user->hasTranslation(\Config::get('constants.LANGUAGE_EN'))){{$user->getTranslation(\Config::get('constants.LANGUAGE_EN'))->description}}@endif</textarea>
                                </div>

                                <input type="submit" value="{{trans('common.btn_save')}}">
                                
                            </fieldset>
                        </form>
                    </div>

                    @endsection



