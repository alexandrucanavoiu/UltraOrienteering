
@extends('layouts/template')

@section('title')
    Ranking Categories - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>
                <h1 class="page-header">Ranking for category {{ $category->name }} - Stage {{ $stage->name }}</h1>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ranking category {{ $category->name }} - Stage {{ $stage->name }}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Participant Name</th>
                                    <th>UUID Card</th>
                                    <th>Total Time</th>
                                </tr>
                                @foreach($participant as $item)
                                <tr>
                                    <td>@if($item->total_time === 'ERROR !!' || $item->total_time === '00:00:00') - @else {{ $number++ }} @endif</td>
                                    <td><strong>{{ $item->participant->name }}</strong> ({{ $item->participant->club->name }})</td>
                                    <td>{{ $item->uuidcard->uuidcard }}</td>
                                    <td>@if($item->total_time === 'ERROR !!' || $item->total_time === '00:00:00') Disqualified @else {{ $item->total_time }} @endif </td>
                                </tr>
                                @endforeach
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection