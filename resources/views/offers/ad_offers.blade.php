@extends('layouts.app')

@section('content')
    <h1> {{trans('offers.add_offers_title')}} </h1>

    <div class="container">
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.title')}}</label>
            <div class="col-sm-6">
                {{$cm_ad->title}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.service')}}</label>
            <div class="col-sm-6">
                {{$service->getTranslation(\Session::get('language'))->service}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.region')}}</label>
            <div class="col-sm-6">
                {{$region->getTranslation(\Session::get('language'))->region}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.content')}}</label>
            <div class="col-sm-6">
               {{$cm_ad->content}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.deadline')}}</label>
            <div class="col-sm-6">
                {{$cm_ad->deadline}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.budget')}}</label>
            <div class="col-sm-6">
                {{$cm_ad->budget}}
            </div>
        </div>
    </div>

    <table class="table table-striped table-bordered table-striped table-hover dataTable">
        <!-- Table Headings -->
                    <thead>
                        <th>{{trans('offers.table_supplier')}}</th>
                        <th>{{trans('offers.table_price')}}</th>
                        <th>{{trans('offers.table_comment')}}</th>
                        <th>{{trans('offers.table_type')}}</th>
                        <th>{{trans('offers.table_deadline')}}</th>
                        <th></th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($cm_offers as $offer)
                        <tr>
                            <td class="table-text">
                                <div>{{ $offer->createdBy['name'] }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $offer->price }}</div>
                            </td>
                            <td class="table-text">
                                <div>
                                    @if($offer->hasTranslation(\Session::get('language')))
                                        {{ $offer->getTranslation(\Session::get('language'))->comment }}
                                    @else
                                        <?php
                                            echo link_to_route('route.offer_translate', $title = trans('common.btn_add_translation'), $parameters = array('cm_ad' => $cm_ad->id, 'cm_offer' => $offer->id), $attributes = array('class' =>"btn btn-warning", 'title' => "{{trans('offers.offer_translate')}}")); 
                                        ?>
                                    @endif
                                </div>
                            </td>
                            <td class="table-text">
                                <div>
                                    @if($offer->hasTranslation(\Session::get('language')))
                                        {{ $offer->getTranslation(\Session::get('language'))->type }}
                                    @endif
                                </div>
                            </td>
                            <td class="table-text">
                                <div>{{ $offer->deadline }}</div>
                            </td>
                            <td>
                                @if(! $cm_ad->date_accepted)
                                <form action="{{ url('/approve_offer/'.$offer->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <?php
                                        echo Form::hidden('cm_ad_id', $cm_ad->id, array('class' => 'form-control'));
                                    ?>
                                    <button type="submit" class="btn btn-success" id="approve" onclick="validate_deletion($offer->id)">
                                        {{trans('offers.btn_approve')}}
                                    </button>
                                </form>
                                @elseif($offer->is_approved)
                                    <label class="label label-success">{{trans('offers.approved')}} </label>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        <?php
            echo link_to_route('route.ads_list', $title = trans('offers.btn_cancel'), $parameters = null, $attributes = array('class' =>"btn btn-default pull-right", 'title' => "{{trans('offers.btn_cancel')}}"));
        ?>
@endsection
