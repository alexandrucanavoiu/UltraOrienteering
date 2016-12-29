
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
                <h1 class="page-header">Ranking Stage </h1>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Total Ranking for all Stages
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
                                    @foreach($concurents as $row)
                                    <tr>
                                        <td>{{ $number++ }}</td>
                                        <td>{{$row['name']}}</td>
                                        <td></td>
                                        <td>{{$row['time']}}</td>
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