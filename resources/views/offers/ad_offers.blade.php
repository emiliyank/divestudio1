@extends('layouts.app')

@section('content')
    <h1> Ad Offers List </h1>

    <div class="container">
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Title</label>
            <div class="col-sm-6">
                {{$cm_ad->title}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Service</label>
            <div class="col-sm-6">
                {{$service->service_en}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Region</label>
            <div class="col-sm-6">
                {{$region->region_en}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Content</label>
            <div class="col-sm-6">
               {{$cm_ad->content}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Deadline</label>
            <div class="col-sm-6">
                {{$cm_ad->deadline}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">Budget</label>
            <div class="col-sm-6">
                {{$cm_ad->budget}}
            </div>
        </div>
    </div>

    <table class="table table-striped table-bordered table-striped table-hover dataTable">
        <!-- Table Headings -->
                    <thead>
                        <th>{{trans('offer.table_supplier')}}</th>
                        <th>{{trans('offer.table_price')}}</th>
                        <th>{{trans('offer.table_comment')}}</th>
                        <th>{{trans('offer.table_type')}}</th>
                        <th>{{trans('offer.table_deadline')}}</th>
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
                                <div>{{ $offer->comment }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $offer->type }}</div>
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
                                    <button type="submit" class="btn btn-success" title="Approve" id="approve" onclick="validate_deletion($offer->id)">
                                        Approve
                                    </button>
                                </form>
                                @elseif($offer->is_approved)
                                    <label class="label label-success">Approved </label>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        <?php
            echo link_to_route('route.ads_list', $title = 'Cancel', $parameters = null, $attributes = array('class' =>"btn btn-default pull-right", 'title' => 'Cancel'));
        ?>
@endsection
