
@extends('layouts/template')

@section('title')
    General Ranking for All Stages - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>

                <h1 class="page-header">General Ranking for All Stages</h1>
            </div>


            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List of Stages
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="center">Nr #</th>
                                    <th class="center">Stage Name</th>
                                    <th class="center">No. Participants</th>
                                    <th></th>
                                </tr>
                                </thead>

                                    <tbody>
                                    @foreach($stages as $key => $stage)
                                    <tr>
                                        <td class="center">{{ $number++ }}</td>
                                        <td class="center">{{ $stage->name }}</td>
                                        <td class="center">
                                            <?php

                                            $participants = DB::table('participant_managers')->where('stage_id', '=', $stage->id )->count();
                                                echo $participants;
                                        ?>
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('/rankings/') }}/{{ $stage->id }}" class="btn btn-success">Ranking by categories</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="{{ URL::to('/total') }}" class="btn btn-primary">General Rankings<a/></td>
                                    </tr>
                                    </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>






        </div>
        <!-- /.row -->

    </div>
@endsection