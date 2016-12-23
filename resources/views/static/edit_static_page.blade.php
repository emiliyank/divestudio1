@extends('layouts.dashboard')

@section('content')
<script>
    $(document).ready(function(){
        CKEDITOR.replace( 'content' );
    });
</script>

<!--Header-->
<div class="header small">
    <div class="overlay">
        <h2>{{trans('static.edit_static_page_title')}}</h2>
    </div>
</div>
<!--Header END-->

<div class="content"><!--Content Starts-->

    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">
                    
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <form action="{{ url('/edit-static-page') }}" method="post" class="form-horizontal">
                        <fieldset>
                            <h4>{{trans('static.add_static_page_subtitle')}}</h4>
                            {{ csrf_field() }}
                            <input type="hidden" name="cm_static_page_id" value="{{$cm_static_page->id}}"/>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <?php 
                                    if($cm_static_page->hasTranslation(\Session::get('language')))
                                    {
                                        $page_topic = $cm_static_page->getTranslation(\Session::get('language'))->topic;
                                        $page_content = $cm_static_page->getTranslation(\Session::get('language'))->content;
                                    }
                                    else
                                    {
                                        $page_topic = '';
                                        $page_content = '';
                                    }
                                    ?>
                                    <label for="topic">{{trans('static.topic')}}<span class="red">*</span>:</label>
                                    <input type="text" name="topic" id="topic" required placeholder="{{trans('static.no_stranlation')}}*" value="{{$page_topic}}">
                                </div>
                            </div> 

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="content">{{trans('static.content')}}<span class="red">*</span>:</label>
                                    <textarea name="content" id="content" placeholder="{{trans('static.no_stranlation')}}*" onFocus="focusLink(true)" onBlur="focusLink(false)" required>{{$page_content}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="{{trans('common.btn_save')}}">
                            </div>
                        </fieldset>
                    </form>
                </div>

                

                @endsection



