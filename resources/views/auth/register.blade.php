@extends('layouts.app')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>Регистрация</h2>
    </div>
</div>

<!--Header END-->

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
                            <label for="user_type" class="col-md-4 control-label">User Type</label>
                            <div class="col-md-6">
                                <select name="user_type" class="form-control" id="user_type">
                                    <option value=""> </option>
                                    <option value="1" {{(old('user_type') == 1) ? "selected":""}}> Client</option>
                                    <option value="2" {{(old('user_type') == 2) ? "selected":""}}> Supplier</option>
                                </select>
                                @if ($errors->has('user_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('cl_organization_type_id') ? ' has-error' : '' }}">
                            <label for="cl_organization_type_id" class="col-md-4 control-label">Organization Type</label>
                            <div class="col-md-6">
                                <select id="cl_organization_type_id" class="form-control" name="cl_organization_type_id">
                                    <option value=""> </option>
                                    @foreach($cl_organization_types as $id => $organization_type)
                                        <option value="{{$id}}" {{(old('cl_organization_type_id') == $id) ? "selected":""}}>{{$organization_type}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('cl_organization_type_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cl_organization_type_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('org_name') ? ' has-error' : '' }}">
                            <label for="org_name" class="col-md-4 control-label">{{trans('auth.org_name')}}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="org_name" value="{{ old('org_name') }}">
                                @if ($errors->has('org_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('org_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group organization{{ $errors->has('reg_number') ? ' has-error' : '' }}">
                            <label for="reg_number" class="col-md-4 control-label">Registration Number</label>
                            <div class="col-md-6">
                                <input id="reg_number" type="text" class="form-control" name="reg_number" value="{{ old('reg_number') }}">
                                @if ($errors->has('reg_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reg_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cl_languages') ? ' has-error' : '' }}">
                            <label for="cl_languages" class="col-md-4 control-label">Languages</label>
                            <div class="col-md-6">
                                <div id="cl_languages" class="form-control">
                                    @foreach($cl_languages as $language)
                                    <label>
                                        <input type="checkbox" {{(old('cl_languages.'.$language) == $language) ? "checked":""  }} name="cl_languages[{{$language}}]" value="{{$language}}"> {{$language}}<br>
                                    </label>
                                    @endforeach
                                </div>
                                @if ($errors->has('cl_languages'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cl_languages') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description">{{old('description')}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('is_receiving_emails') ? ' has-error' : '' }}">
                            <label for="is_receiving_emails" class="col-md-4 control-label">To Receive e-mails</label>
                            <div class="col-md-6">
                                <label class="control-label">
                                    <input id="is_receiving_emails" type="radio" name="is_receiving_emails" value="0" {{(old('is_receiving_emails') === '0') ? "checked":""  }}> No &nbsp; &nbsp;
                                </label>
                                <label class="control-label">
                                    <input type="radio" name="is_receiving_emails" value="1" {{(old('is_receiving_emails') === '1') ? "checked":""  }}> Yes
                                </label>
                                @if ($errors->has('is_receiving_emails'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_receiving_emails') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group supplier">
                            <label for="cl_regions" class="col-md-4 control-label">Regions</label>
                            <div class="col-md-6">
                                <div id="all_regions" class="form-control">
                                    &nbsp; &nbsp;
                                    <a href="javascript:void(0)" onclick="$('#cl_regions :checkbox').prop('checked', true); $(this).blur()"><small>Select All</small></a>
                                    &nbsp; &nbsp;
                                    <a href="javascript:void(0)" onclick="$('#cl_regions :checkbox').prop('checked', false); $(this).blur()"><small>Deselect All</small></a>
                                    <div id="cl_regions">
                                        @foreach($cl_regions as $id => $region)
                                        <label>
                                            <input type="checkbox" {{(old('regions.'.$id) == $id) ? "checked":""  }} name="regions[{{$id}}]" value="{{$id}}"> {{$region}}<br>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                         <div id="all_services" class="form-control supplier">
                             <table class="table">
                                 <thead> 
                                     <tr> 
                                         <th>Services</th>
                                         <th>Min. budget /BGN/</th>
                                     </tr>
                                 </thead>
                             </table>
                             <div id="cl_services">
                                 <table class="table table-striped">
                                    @foreach($cl_services as $id => $service)
                                    <tr>
                                        <td>
                                            <input type="checkbox" {{(old('services.'.$id) == $id) ? "checked":""  }} name="services[{{$id}}]" value="{{$id}}">
                                        </td>
                                        <td>
                                            {{$service}}
                                        </td>
                                        <td>
                                            <input id="budget_{{$id}}" type="text" class="form-control" name="budget[{{$id}}]" value="{{ old('budget.'.$id) }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                 </table>
                             </div>
                         </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
