@extends('layouts.dashboard')

@section('content')
<script type="text/javascript">
    function show_only(id,filter){
        $('.user-data').fadeOut();
        $('#users-filter').html(filter);
        if (id==0) { $('.user-data').fadeIn(); }
        else{ $('*[data-type="'+id+'"]').fadeIn(); }
    }
</script>

<div class="header small">
	<div class="overlay">
    	<h2>{{trans('users.list_all_users_title')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->
<section class="profile">
<div class="container">
    <div class="boxes layout-left">
        <div class="box">
            @if (Session::has('deleted_user'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger">{{ Session::get('deleted_user') }}</div>
                    </div>
                </div>
            @endif
            <a href="{{url('/add-user/')}}">
                <input type="submit" value="{{trans('users.add_admin_btn')}}">
            </a>

            <div class="article-filter center">
                <p>
                    <a href="javascript:void(0)" onclick="show_only(0,'&nbsp;')">Всички типове</a> 
                    @foreach($cl_roles as $cl_role)
                        <a href="javascript:void(0)" onclick="show_only({{$cl_role->id}},'{{$cl_role->getTranslation(\Session::get('language'))->role}}')">{{$cl_role->getTranslation(\Session::get('language'))->role}}</a>
                    @endforeach
                </p>
    	   </div>
            <h2 id="users-filter" class="center">&nbsp;</h2>

            <table class="table table-bordered" border="1">
                <tr>
                    <td> {{trans('users.th_user')}}</td>
                    <td> {{trans('users.th_email')}}</td>
                    <td> {{trans('users.th_role')}}</td>
                    <td> </td>
                </tr>
                @foreach($all_users as $user)
                    <tr class="user-data" data-type="{{$user->user_type}}">
                        <td> 
                            @if($user->hasTranslation(\Session::get('language')))
                                {{$user->getTranslation(\Session::get('language'))->name}}
                            @else
                                -
                            @endif
                        </td>
                        <td> {{$user->email}}</td>
                        <td> <?php print_r($user->userType->getTranslation(\Session::get('language'))->role); ?></td>
                        <td>
                            <form action="{{url('/delete-user')}}" method="post" onsubmit="return confirm('Наистина ли искате да изтриете този потребител?');">
                                {{ csrf_field('DELETE') }}
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="user_id" value="{{$user->id}}"/>

                                <button type="submit" class="btn btn-danger" title="Delete" id="delete">
                                    <i class="fa fa-trash"></i>{{trans('common.delete_btn')}}
                                </button>
                            </form>
                        </td>
                	</tr>
                @endforeach
            </table>
        </div>
@stop