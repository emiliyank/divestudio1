@extends('layouts.unauthorized')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>Регистрация</h2>
    </div>
</div>

<!--Header END-->
<div class="content"><!--Content Starts-->
    <section>
        <div class="container">

            <h4>Роля</h4>
            <p class="center">Моля изберете вашата роля. (Прочетете <a href="#">повече за ролите тук</a>.)</p>
            <ul class="role-select">
        	<li><a href="javascript:void(0)" onClick="$('.supply').hide(); $('.demand').fadeIn(); $('#user_type').val('1');">Търсещ</a></li>
                <li><a href="javascript:void(0)" onClick="$('.demand').hide(); $('.supply').fadeIn(); $('#user_type').val('2');">Предлагащ</a></li>
            </ul>
            
            <div id="contract">
                <h4 class="demand" style="{{old('user_type')!=2 ? '' : 'display:none'}}">Търсещ услуга</h4>
                <h4 class="supply" style="{{old('user_type')==2 ? '' : 'display:none'}}">Предлагащ услуга</h4>
                @if ($errors->any())
@foreach($errors->all() as $error)
<p>{{$error}}</p>
@endforeach
                @endif            
                <form id="registration-form" method="post" action="{{ url('/register') }}">
                <fieldset>
                    {{ csrf_field() }}
                    <input type="hidden" name="user_type" id="user_type" value="{{old('user_type')==2 ? '2' : '1'}}"/>

                    <p>Информация за потребителя:</p>
                    
                    <label for="email">Email<span class="red">*</span>:</label>
@if ($errors->has('email'))<strong>{{$errors->first('email')}}</strong>@endif
                    <input type="email" name="email" id="email" class="email" required placeholder="Email*" value="{{ old('email') }}">

                    <label for="password">Парола<span class="red">*</span>:</label>
@if ($errors->has('password'))<strong>{{$errors->first('password')}}</strong>@endif
                    <input type="password" name="password" id="password" class="password" required placeholder="Парола*">
                    
                    <label for="password_confirmation">Повтори парола<span class="red">*</span>:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="password" required placeholder="Повтори парола*">
                    
                    <label for="username">Потребителско име<span class="red">*</span>:</label>
@if ($errors->has('username'))<strong>{{ $errors->first('username') }}</strong>@endif
                    <input type="text" name="username" id="username" class="username" required placeholder="Потребителско име*" value="{{ old('username') }}">
                    
                    <p>Допълнителна информация:</p>
                    
                    <label for="name">Вашето име<span class="red">*</span>:</label>
@if ($errors->has('name'))<strong>{{ $errors->first('name') }}</strong>@endif
                    <input type="text" name="name" id="name" class="name" required placeholder="Вашето име*" value="{{ old('name') }}">
                
                    <label for="phone">Телефон за връзка<span class="red">*</span>:</label>
@if ($errors->has('phone'))<strong>{{ $errors->first('phone') }}</strong>@endif
                    <input type="tel" name="phone" id="phone" class="telephone" required placeholder="Телефон за връзка*" value="{{ old('phone') }}">

                    <label for="cl_organization_type_id">Вид правен субект:</label>
@if ($errors->has('cl_organization_type_id'))<strong>{{ $errors->first('cl_organization_type_id') }}</strong>@endif
                    <select name="cl_organization_type_id" id="cl_organization_type_id">
                        <option value="" selected style="display: none">Вид правен субект:</option>
@foreach($cl_organization_types as $id => $organization_type)
                        <option value="{{$id}}" {{(old('cl_organization_type_id')==$id) ? "selected":""}}>{{$organization_type}}</option>
@endforeach
                    </select>
                    
                    <label for="org_name">Име на фирма:</label>
                    <input type="text" name="org_name" id="org_name" class="company" placeholder="Име на фирма" value="{{ old('org_name') }}">
                
                    <label for="reg_number">ЕИК номер:</label>
                    <input type="text" name="reg_number" id="reg_number" class="eik" placeholder="ЕИК номер" value="{{ old('reg_number') }}">
                
                    <label for="vat_number">ДДС номер:</label>
                    <input type="text" name="vat_number" id="vat_number" class="dds" placeholder="ДДС номер" value="{{ old('vat_number') }}">
                
                    <label for="address">Адрес:</label>
                    <input type="text" name="address" id="address" class="address" placeholder="Адрес" value="{{ old('address') }}">

                    <div class="supply" style="{{old('user_type')==2 ? '' : 'display:none'}}">
                        <p>Региони на дейност:</p>
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
                       
                        <p>Сфери на дейност и минимален бюджет (в лева):<br/>
                        <em>(Оставете празно или нула за неограничен бюджет)</em></p>
                        <hr>
@foreach($cl_services as $service)
                        <div class="checkbox">
                            <input type="checkbox" {{(old('services.'.$service->id) == $service->id) ? "checked":""}} name="services[{{$service->id}}]" id="supply-filed{{$service->id}}" value="{{$service->id}}" data-related-item="supply-budget{{$service->id}}">
                            <label for="supply-filed{{$service->id}}">{{$service->getTranslation(\Session::get('language'))->service}}</label>
                        </div>
                        <div style="display: none;">
                            <label for="supply-budget{{$service->id}}">Минимален бюджет:</label>
                            <input type="number" min="0" name="budget[{{$service->id}}]" id="supply-budget{{$service->id}}" class="budget" placeholder="Минимален бюджет" value="{{ old('budget.'.$service->id) }}">
                        </div>
@endforeach
                        <p>Език:</p>
@if ($errors->has('cl_languages'))<strong>{{$errors->first('cl_languages')}}</strong>@endif
                        <hr> 
@foreach($cl_languages as $id => $language)
                        <div class="checkbox">
                            <input type="checkbox" name="cl_languages[{{$language}}]" id="cl_languages{{$id}}" value="{{$language}}" onchange="toggle_description({{$id}})" {{(old('cl_languages.'.$language) == $language) ? "checked":""}}>
                            <label for="cl_languages{{$id}}">{{$language}}</label>
                        </div>
@endforeach
                        <p>Описание на профила:</p>
                        <label for="description0">Описание на български език<span class="red">*</span>:</label>
        		<textarea name="description" id="description0" placeholder="Описание на български език*" onFocus="focusLink(true)" onBlur="focusLink(false)"></textarea>
                        <div id="description-wrapper1" style="display: none;">
                            <label for="description1">Описание на английски език<span class="red">*</span>:</label>
                            <textarea name="description" id="description1" placeholder="Описание на английски език*" onFocus="focusLink(true)" onBlur="focusLink(false)"></textarea>
                        </div>
                        
                        <script type="text/javascript">
                            function toggle_description(id){
                                if ($('#cl_languages'+id).is(':checked')){ $('#description-wrapper'+id).slideDown(); }
                                else{ $('#description-wrapper'+id).slideUp(); }
                            }
			</script>

                    </div>

                    <div class="checkbox">
                        <input type="checkbox" name="agreement" id="agreement" required {{(old('agreement') == "Agreed with Ptivacy Policy") ? "checked":""  }} value="Agreed with Ptivacy Policy">
                        <label for="agreement">Прочел съм и съм съгласен с <a href="#" target="_blank">Общите условия</a><span class="red">*</span></label>
                    </div>
                
                    <input type="submit" value="Продължи">
                    
                </fieldset>
                </form> 
            </div>
        </div>
    </section>
</div><!--Content Ends-->
@endsection
