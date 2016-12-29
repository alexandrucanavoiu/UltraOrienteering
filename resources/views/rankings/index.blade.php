
@extends('layouts/template')

@section('title')
    Ranking - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>

                <h1 class="page-header">General Ladderboard ( By Stages )</h1>
            </div>


            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Stages
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="center">Nr #</th>
                                    <th class="center">Stage Name</th>
                                    <th class="center">Number of Participants</th>
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
                                            <a href="{{ URL::to('/ladderboard/') }}/{{ $stage->id }}" class="btn btn-success">Category Rankings</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="{{ URL::to('/total') }}" class="btn btn-primary">General Ladderboard<a/></td>
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