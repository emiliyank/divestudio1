@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="ad">Add new ad</a>
        <table class="table table-striped">
        @foreach($ads as $ad)
            <tr>
                <td>
                    <a href="ad/{{$ad['id']}}">{{$ad['title']}}</a>
                </td>
            </tr>
        @endforeach
        </table>
    </div>
@endsection



