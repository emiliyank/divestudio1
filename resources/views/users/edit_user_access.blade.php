@extends('layouts.dashboard')

@section('content')
<!--Header-->
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('users.edit_user_access_title')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->

    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">
                    @if (Session::has('updated_user_access'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-success">{{ Session::get('updated_user_access') }}</div>
                        </div>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <form action="{{ url('/edit-user-access') }}" method="post">
                        <fieldset>
                            {{csrf_field()}}
                            <input type="hidden" name="user_id" value="{{$user_id}}"/>
                            <h4>{{trans('users.edit_accesses_subtitle')}}</h4>
                                <p> {{trans('users.for_user')}}: {{$user_email}}</p>
                                <p style="font-size: 26px;">
                                    <a href="javascript:void(0)" onclick="$('.checkboxes-group :checkbox').prop('checked', true); $(this).blur()"><i class="fa fa-check-square"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="javascript:void(0)" onclick="$('.checkboxes-group :checkbox').prop('checked', false); $(this).blur()"><i class="fa fa-square"></i></a>
                                </p>
                                <div class="checkboxes-group"> 
                                    @foreach($all_accesses as $access)
                                    <?php
                                    $selected='';
                                    if(in_array($access->id, $user_access_ids))
                                    {
                                        $selected = 'checked';
                                    }
                                    ?>
                                    <div class="checkbox">
                                        <input type="checkbox" name="cl_access_id[{{$access->id}}]" id="cl_access_id[{{$access->id}}]" value="{{$access->id}}" {{$selected}}>
                                        <label for="cl_access_id[{{$access->id}}]">
                                            @if($access->hasTranslation(\Session::get('language')))
                                                {{$access->getTranslation(\Session::get('language'))->access}}
                                            @else
                                                {{trans('common.no_translation')}}
                                            @endif
                                        </label>
                                    </div>
                                    @endforeach
                                </div>

                            <input type="submit" value="{{trans('common.btn_save')}}">
                        </fieldset>
                    </form>

                </div>

                @endsection



