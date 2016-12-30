@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('register.registration')}}</h2>
    </div>
</div>

<!--Header END-->
<div class="content"><!--Content Starts-->
    <section>
        <div class="container">

            <h4>{{trans('register.role')}}</h4>
            <p class="center">{{trans('register.choice_role')}} <a href="{{url('about-roles')}}" target="_blank">{{trans('register.more_for_roles')}}</a>.)</p>
            <ul class="role-select">
        	<li><a href="javascript:void(0)" onClick="$('.supply').hide(); $('.demand').fadeIn(); $('#user_type').val('1');">{{trans('common.btn_seeking')}}</a></li>
                <li><a href="javascript:void(0)" onClick="$('.demand').hide(); $('.supply').fadeIn(); $('#user_type').val('2');">{{trans('common.btn_supplier')}}</a></li>
            </ul>

            <div id="contract">
                <h4 class="demand" style="{{old('user_type')!=2 ? '' : 'display:none'}}">{{trans('common.search_services')}}</h4>
                <h4 class="supply" style="{{old('user_type')==2 ? '' : 'display:none'}}">{{trans('common.offers_services')}}</h4>
@if ($errors->any())
    @foreach($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
@endif            
                <form id="registration-form" method="post" action="{{ url('/register') }}">
                <fieldset>
                    {{ csrf_field() }}
                    <input type="hidden" name="user_type" id="user_type" value="{{old('user_type')==2 ? '2' : '1'}}"/>

                    <p>{{trans('register.user_information')}}:</p>
                    
                    <label for="email">Email<span class="red">*</span>:</label>
@if ($errors->has('email'))<strong>{{$errors->first('email')}}</strong>@endif
                    <input type="email" name="email" id="email" class="email" required placeholder="Email*" value="{{ old('email') }}">

                    <label for="password">{{trans('common.password')}}<span class="red">*</span>:</label>
@if ($errors->has('password'))<strong>{{$errors->first('password')}}</strong>@endif
                    <input type="password" name="password" id="password" class="password" required placeholder="{{trans('common.password')}}*">
                    
                    <label for="password_confirmation">{{trans('common.password_confirmation')}}<span class="red">*</span>:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="password" required placeholder="{{trans('common.password_confirmation')}}*">
                    
                    <label for="username">{{trans('common.username')}}<span class="red">*</span>:</label>
@if ($errors->has('username'))<strong>{{ $errors->first('username') }}</strong>@endif
                    <input type="text" name="username" id="username" class="username" required placeholder="{{trans('common.username')}}*" value="{{ old('username') }}">
                    
                    <p>{{trans('register.additional_information')}}:</p>
                    
                    <label for="name">{{trans('users.name')}}<span class="red">*</span>:</label>
@if ($errors->has('name'))<strong>{{ $errors->first('name') }}</strong>@endif
                    <input type="text" name="name" id="name" class="name" required placeholder="{{trans('users.name')}}*" value="{{ old('name') }}">
                
                    <label for="phone">{{trans('users.phone')}}<span class="red">*</span>:</label>
@if ($errors->has('phone'))<strong>{{ $errors->first('phone') }}</strong>@endif
                    <input type="tel" name="phone" id="phone" class="telephone" required placeholder="{{trans('users.phone')}}*" value="{{ old('phone') }}">

                    <label for="cl_organization_type_id">{{trans('users.org_type')}}</label>
@if ($errors->has('cl_organization_type_id'))<strong>{{ $errors->first('cl_organization_type_id') }}</strong>@endif
                    <select name="cl_organization_type_id" id="cl_organization_type_id">
                        <option value="" selected>{{trans('users.org_type')}}</option>
@foreach($cl_organization_types as $organization_type)
                        <option value="{{$organization_type->id}}" {{(old('cl_organization_type_id')==$organization_type->id) ? "selected":""}}>{{$organization_type->getTranslation(\Session::get('language'))->organization_type}}</option>
@endforeach
                    </select>
                    
                    <label for="org_name">{{trans('users.org_name')}}</label>
                    <input type="text" name="org_name" id="org_name" class="company" placeholder="{{trans('users.org_name')}}" value="{{ old('org_name') }}">
                
                    <label for="reg_number">{{trans('users.reg_number')}}</label>
                    <input type="text" name="reg_number" id="reg_number" class="eik" placeholder="{{trans('users.reg_number')}}" value="{{ old('reg_number') }}">
                
                    <label for="vat_number">{{trans('users.vat_number')}}</label>
                    <input type="text" name="vat_number" id="vat_number" class="dds" placeholder="{{trans('users.vat_number')}}" value="{{ old('vat_number') }}">
                
                    <label for="address">{{trans('users.address')}}</label>
                    <input type="text" name="address" id="address" class="address" placeholder="{{trans('users.address')}}" value="{{ old('address') }}">

                    <div class="supply" style="{{old('user_type')==2 ? '' : 'display:none'}}">
                        <p>{{trans('users.regions_label')}}</p>
                        <hr>
                        <p style="font-size: 26px;">
                            <a href="javascript:void(0)" onclick="$('.checkboxes-group :checkbox').prop('checked', true); $(this).blur()"><i class="fa fa-check-square"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="javascript:void(0)" onclick="$('.checkboxes-group :checkbox').prop('checked', false); $(this).blur()"><i class="fa fa-square"></i></a>
                        </p>
                        <div class="checkboxes-group">
@foreach($cl_regions as $region)
                            <input type="checkbox" {{(old('regions.'.$region->id) == $region->id) ? "checked":""}} name="regions[{{$region->id}}]" id="regions[{{$region->id}}]" value="{{$region->id}}">
                            <label for="regions[{{$region->id}}]">{{$region->getTranslation(\Session::get('language'))->region}}</label><br/>
@endforeach
                        </div>
                       
                        <p>{{trans('users.services_label')}}<br/><em>{{trans('users.services_help_text')}}</em></p>
                        <hr>
@foreach($cl_services as $service)
                        <div class="checkbox">
                            <input type="checkbox" {{(old('services.'.$service->id) == $service->id) ? "checked":""}} name="services[{{$service->id}}]" id="supply-filed{{$service->id}}" value="{{$service->id}}" data-related-item="supply-budget{{$service->id}}">
                            <label for="supply-filed{{$service->id}}">{{$service->getTranslation(\Session::get('language'))->service}}</label>
                        </div>

                        <div style="display: none;">
                            <label for="supply-budget{{$service->id}}">{{trans('users.min_budget_placeholder')}}:</label>
                            <input type="number" min="0" name="budget[{{$service->id}}]" id="supply-budget{{$service->id}}" class="budget" placeholder="{{trans('users.min_budget_placeholder')}}" value="{{old('budget.'.$service->id)}}">
                        </div>
@endforeach
                        <p>{{trans('users.language_label')}}</p>
@if ($errors->has('cl_languages'))<strong>{{$errors->first('cl_languages')}}</strong>@endif
                        <hr>
@foreach($cl_languages as $language)
                        <div class="checkbox">
                            <input type="checkbox" name="cl_languages[{{$language->locale_code}}]" id="cl_language_{{$language->locale_code}}" value="{{$language->language}}" onchange="toggle_description('{{$language->locale_code}}')" {{(old('cl_languages.'.$language->locale_code) == $language->language) || $language->locale_code == 'bg' ? "checked":""}}>
                            <label for="cl_language_{{$language->locale_code}}">{{$language->language}}</label>
                        </div>
@endforeach
                        <p>{{trans('users.description_label')}}</p>
                        <label for="description_bg">{{trans('users.description_bg')}}<span class="red">*</span>:</label>
                        <textarea name="description[bg]" id="description_bg" placeholder="{{trans('users.description_bg')}}*" onFocus="focusLink(true)" onBlur="focusLink(false)">{{old('description.bg')}}</textarea>
@foreach($cl_languages as $language)
    @if ($language->locale_code != 'bg')

                        <div id="description-wrapper_{{$language->locale_code}}" style="{{old('cl_languages.'.$language->locale_code) ? "":"display: none"}}">
                            <label for="description_{{$language->locale_code}}">{{trans('users.description_'.$language->locale_code)}}<span class="red">*</span>:</label>
                            <textarea name="description[{{$language->locale_code}}]" id="description_{{$language->locale_code}}" placeholder="{{trans('users.description_'.$language->locale_code)}}*" onFocus="focusLink(true)" onBlur="focusLink(false)">{{old('description.'.$language->locale_code)}}</textarea>
                        </div>
    @endif
@endforeach

                        <script type="text/javascript">
                            function toggle_description(id){
                                if (id == 'bg'){ $('#cl_language_bg').prop('checked', true); }
                                if ($('#cl_language_'+id).is(':checked')){ $('#description-wrapper_'+id).slideDown(); }
                                else{ $('#description-wrapper_'+id).slideUp(); }
                            }
                        </script>

                    </div>

                    <div class="checkbox">
                        <input type="checkbox" name="agreement" id="agreement" required {{(old('agreement') == "Agreed with Ptivacy Policy") ? "checked":""  }} value="Agreed with Ptivacy Policy">
                        <label for="agreement">{{trans('common.have_read')}} <a href="{{url('terms-and-conditions')}}" target="_blank">{{trans('common.terms_and_conditions')}}</a><span class="red">*</span></label>
                    </div>
                
                    <input type="submit" value="{{trans('common.btn_continue')}}">
                    
                </fieldset>
                </form> 

@endsection
