@extends('layouts/template')
@section('title') Import Log Details - Ultra Orienteering Software - Open Source Software @endsection
@section('body')
    <section class="content-header">
        <h1>
            IMPORT LOG
            <small>Details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/import-log">Import Log</a></li>
            <li><a href="#">Details</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <span class="pull-left">
                        <a href="/import-log" class="btn btn-primary pull-left"><i class="fa  fa-mail-reply"></i> BACK </a>
                    </span>
                </h1>
            </div>
        </div>
        <br />
        @if(!empty($errors))
            <div class="row">
                <div class="col-md-6 col-lg-offset-3">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-warning"></i>

                        <h3 class="box-title">Errors! The import could not be performed. </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @foreach($errors as $error)
                            @foreach($error as $key => $err)
                                @if($key == 'uuid')
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> {{ $err }}</h4>
                            <p> This UUID CAARD isn't  in the database. Please check the log file.</p>
                        </div>
                                @else
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> #{{ $key }} - UUID CARD {{ $err }}</h4>
                            <p>This UUID CARD isn't asociated at this Stage. Please check the Participants.</p>
                        </div>
                                @endif
                                @endforeach
                        @endforeach
                        Before importing again this file. Please resolve the issues displayed above.
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            </div>
            @else
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="routes table table-bordered">
                            <tbody>
                            <tr>
                                <th class="center" style="width: 20%">Participant</th>
                                <th class="center" style="width: 10%">UUID Card</th>
                                <th class="center" style="width: 10%">Category</th>
                                <th class="center" style="width: 3%">Missed Post</th>
                                <th class="center" style="width: 10%">Order Posts</th>
                            </tr>
                            @foreach($response_data as $data)
                                <tr class="import-list @if($data['posts_missed'] == NULL)bg-green-gradient @else bg-red-gradient @endif">
                                    <td>{{ $data['participant_name'] }} ({{ $data['team_name'] }})</td>
                                    <td>Nr #{{ $data['uuid_id'] }} ({{ $data['uuid_name'] }})</td>
                                    <td class="center">{{ $data['category'] }}</td>
                                    <td class="center">@if($data['posts_missed'] == NULL) NO @else Yes @endif</td>
                                    <td>
                                        @if(!empty($data['posts_participant']))
                                            @foreach($data['posts_participant'] as $key => $participant_posts)
                                                <div>Post: {{ $key }} - Time: {{ $participant_posts }}</div>
                                            @endforeach
                                            @else
                                            <div class="center">OK</div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        @endif
    </section>
@endsection