@extends('layouts.dashboard')

@section('content')
<div class="header small">
	<div class="overlay">
    	<h2>{{trans('cl_services.list_all_services_title')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->
<section class="profile">
<div class="container">
    <div class="boxes layout-left">
        <div class="box">
            <table class="table table-bordered" border="1">
                <tr>
                    <td> {{trans('cl_services.th_service')}}</td>
                    <td> {{trans('cl_services.th_description')}}</td>
                </tr>
                @foreach($cl_services as $cl_service)
                    <tr>
                        <td>
                            @if($cl_service->hasTranslation(\Session::get('language')))
                                {{$cl_service->getTranslation(\Session::get('language'))->service}}
                            @else
                                -
                            @endif
                        </td>
                         <td> 
                            @if($cl_service->hasTranslation(\Session::get('language')))
                                {{$cl_service->getTranslation(\Session::get('language'))->description}}
                            @else
                                -
                            @endif
                        </td>
                	</tr>
                @endforeach
            </table>
        </div>
@stop