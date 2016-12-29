
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
                <h1 class="page-header">General Rangkins of All Stages <a target="_blank" href="/total/exportPDF" class="btn btn-warning float-right">Export to PDF</a><a href="/rankings" class="btn btn-primary float-right">Back to RANKING Index</a></h1>

            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                    </div>
                    <div class="panel-body">


                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Participant Name</th>
                                    <th>Club Name</th>
                                    <th>Total Time</th>
                                </tr>
                                    @foreach($concurents as $row)
                                        @if($row['time'] !== "00:00:00")
                                            <tr>
                                                <td>{{ $number++ }}</td>
                                                <td>{{$row['name']}}</td>
                                                <td>{{$row['club']}}</td>
                                                <td>{{$row['time']}}</td>
                                            </tr>
                                        @endif
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