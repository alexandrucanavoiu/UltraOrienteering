
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
                <h1 class="page-header">Rankings for Stage {{ $stage->name }} <a href="/ladderboard" class="btn btn-primary float-right">Back to LADDERBOARD Index</a></h1>
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
                                    <th class="center">#</th>
                                    <th class="center">Category Name</th>
                                    <th class="center">Numbers of Participants</th>
                                    <th class="center"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($category as $item)
                                <tr>
                                    <td class="center">{{ $number++ }}</td>
                                    <td class="center">{{ $item->name }}</td>
                                    <td class="center">
                                        <?php
                                        $participants = DB::table('participant_managers')->where('stage_id', '=', $stage->id )->where('category_id', '=', $item->id )->count();
                                        echo $participants;
                                        ?>
                                    </td class="center">
                                    <td class="center"><a href="{{ URL::to('/ladderboard/') }}/{{ $stage->id }}/{{ $item->id }}" class="btn btn-success">View</a></td>
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