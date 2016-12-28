
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
                <h1 class="page-header">Rankings for Stage {{ $stage->name }}</h1>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Lists of Categories
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Numbers of Participants</th>
                                    <th>Ranking</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($category as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ $item->name }}</td>
                                    <td></td>
                                    <td><a href="{{ URL::to('/rankings/') }}/{{ $stage->id }}/{{ $item->id }}" class="btn btn-success">Ranking List</a></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection