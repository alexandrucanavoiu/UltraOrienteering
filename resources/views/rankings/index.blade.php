
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

                <h1 class="page-header">Rankings</h1>
            </div>


            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Rankings for Stages
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nr #</th>
                                    <th>Stage Name</th>
                                    <th>Number of Participants</th>
                                    <th></th>
                                </tr>
                                </thead>
                                @foreach($stages as $key => $stage)
                                    <tbody>
                                    <tr>
                                        <td>{{ $number++ }}</td>
                                        <td>{{ $stage->name }}</td>
                                        <td>
                                            <?php

                                            $participants = DB::table('participant_managers')->where('stage_id', '=', $stage->id )->count();
                                                echo $participants;
                                        ?>
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('/rankings/') }}/{{ $stage->id }}" class="btn btn-success">Rankings for Categories</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <!-- /.row -->

    </div>
@endsection