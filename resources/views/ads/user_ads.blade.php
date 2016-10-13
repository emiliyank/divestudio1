@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="ad">Add new ad</a><br/><br/>

        <div class="panel panel-default">
            <div class="panel-heading">
                Current Ads
            </div>
            <div class="panel-body">
                @if ($current)
                <table class="table table-striped ads_list">
                    <?php echo $current ?>
                </table>
                @else
                ...
                @endif
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Announced Expired
            </div>
            <div class="panel-body">
                @if ($expired)
                <table class="table table-striped ads_list">
                    <?php echo $expired ?>
                </table>
                @else
                ...
                @endif
            </div>
        </div>

    </div>
@endsection


