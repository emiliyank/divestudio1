@extends('layouts.dashboard')

@section('content')
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('contact.received_contacts')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->
    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">
                    <div class="article-filter center">
                        <p>
                            <a href="javascript:void(0)" onclick="show_only('')">Всички</a>
                            @foreach($cl_statuses as $cl_status)
                                <a href="javascript:void(0)" onclick="show_only('{{$cl_status->status}}')">{{$cl_status->status}}</a>
                            @endforeach
                        </p>
                    </div>    
                    @foreach($cm_feedbacks as $feedback_id => $cm_feedback)
                    <div class="user-box feedback-status" data-status='{{$cm_feedback->cl_status_id}}'>
                        <div class="header">
                            <h5>
                                {{trans('contact.theme')}}:
                                @if (!$cm_feedback->cl_feedback_topic_id)
                                ---
                                @else
                                {{$cl_feedback_topics[$cm_feedback->cl_feedback_topic_id-1]->getTranslation(\Session::get('language'))->feedback_topic}}
                                @endif
                            </h5>
                        </div>
                        <div class="container">
                            <p class="date">{{trans('ads.created_at')}}
                                <span>{{date('d.m.Y / H:i',strtotime($cm_feedback->created_at))}}</span>
                                {{trans('contact.status')}}:
                                <span>{{$cm_feedback->cl_status_id}}</span>
                            </p>
                            <form action="{{ url('/contact-status') }}" method="post">
                                {{ csrf_field() }}
                                <input type='hidden' name='contact_id' value="{{$cm_feedback->id}}"
                                <p class="date">{{trans('contact.status')}}:
                                    <select class="form-control cl_status_id" name="cl_status_id">
                                        @foreach ($cl_statuses as $cl_status)
                                        <?php
                                        if($cm_feedback->cl_status_id === $cl_status->status){ $selected = 'selected'; }
                                        else{ $selected = ''; }
                                        ?>
                                        <option value='{{$cl_status->status}}' {{$selected}}>{{$cl_status->status}}</option>
                                        @endforeach
                                    </select>
                                </p>
                            </form>
                            <p>{{$cm_feedback->feedback}}</p>
                            <hr/>
                            <p class="author">{{trans('ads.author')}} <span>{{$cm_feedback->name}}</span></p>
                            <p class="tags">Email: <span>{{$cm_feedback->email}}</span></p>
                            <p class="tags">{{trans('users.phone')}}: <span>{{$cm_feedback->phone}}</span></p>
                        </div>

                    </div>
                    @endforeach
    <script type="text/javascript">
    function show_only(filter){
        $('.feedback-status').fadeOut();
        if (filter=='') { $('.feedback-status').fadeIn(); }
        else{ $('*[data-status="'+filter+'"]').fadeIn(); }
    }
    $('.cl_status_id').change(function(){
        $(this).closest('form').trigger('submit');
    });
    </script>
</div>
                
                @endsection

