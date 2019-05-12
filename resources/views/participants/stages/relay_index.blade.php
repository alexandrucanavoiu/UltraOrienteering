@extends('layouts/template')
@section('title') Stages Administration - Ultra Orienteering Software - Open Source Software @endsection
@section('body')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="/participants">Participants</a></li>
            <li><a href="#">Stages</a></li>
        </ol>
    </section>

    <section class="content">
        <br /><br />
        <div class="row">
            <div class="col-md-2">
                <br />
                <br />
                <br />
                <br />
                <h1 class="page-header">
                    <span class="pull-right">
                        <a href="javascript:history.back()" class="btn btn-primary pull-left"><i class="fa fa-arrow-left"></i> BACK</a>
                    </span>
                </h1>
            </div>
            <div class="col-md-6 col-lg-offset-1">
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-blue-active">
                        <h3 class="widget-user-username">Relay Competition</h3>
                        <h5 class="widget-user-desc">All achieved times will accumulate.</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="/images/orienteering.png" alt="User Avatar">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-2 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $count_participants }}</h5>
                                    <span class="description-text">Participants</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-8 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"></h5>
                                    <span class="description-text">
                                        @foreach($list_participants as $team)
                                            <div>{{ $team->participant_name }}</div>
                                        @endforeach</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-2">
                                <div class="description-block">
                                    <h5 class="description-header participants-stages-count">{{ $count_arrayParticipantsStages }}</h5>
                                    <span class="description-text">STAGES</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <br />
                <br />
                <br />
                <br />
                <h1 class="page-header">
                    <span class="pull-right">
                        <a href="#" class="btn btn-primary pull-left js--add-value-id js--create-participants-stages"  data-id="{{ $participant_id }}" data-toggle="modal" data-target="#myModal-Participants-Stages-create">Enroll in a Stage</a>
                    </span>
                </h1>
            </div>

            @foreach($arrayParticipantsStagesDetails as $key => $stage)
            <div class="col-lg-12 participants-stages-{{ $stage['stages_id'] }}">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Stage {{ $stage['stage_name'] }} </h3>
                        <div class="box-tools pull-right">
                            <a href="#"><li class="fa fa-edit text-blue js--edit-relay-participant-stages js--add-value-participants-stages-id js--add-value-id" data-participants-id="{{ $stage['participant_id'] }}" data-stages-id="{{ $stage['stages_id'] }}" data-toggle="modal" data-target="#myModal-Participants-Stages-edit"> Edit </li></a>&nbsp;&nbsp;
                            <a href="#"><li class="fa fa-remove text-red js--add-value-participants-stages-id js--add-value-id" data-participants-id="{{ $stage['participant_id'] }}" data-id="{{ $stage['stages_id'] }}" data-toggle="modal" data-target="#myModal-Relay-Participants-Stages-delete"> Remove</li></a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="participants-stages table table-bordered">
                            <tbody>
                            <tr>
                                <th class="center" style="width: 30%">Participant Name</th>
                                <th class="center" style="width: 25%">Category / Route</th>
                                <th class="center" style="width: 10%">Total Time</th>
                                <th class="center" style="width: 10%">Missed Posts</th>
                                <th class="center" style="width: 10%">Abandon</th>
                                <th class="center" style="width: 10%">Actions</th>
                            </tr>
                            @foreach($stage['participants'] as $key => $participant)
                                <tr class="participants-stages-{{ $participant['participant_stage_id'] }}">
                                    <td class="participant-name-{{ $participant['participant_stage_id'] }} center">{{ $participant['participant_name'] }}</td>
                                    <td class="categoy-name-{{ $participant['participant_stage_id'] }} }} center">{{ $participant['category'] }} / {{ $participant['route'] }} </td>
                                    <td class="total-time-{{ $participant['participant_stage_id'] }} }} center">{{ $participant['total_time'] }}</td>
                                    <td class="missed-posts-{{ $participant['participant_stage_id'] }} }} center">{{ $participant['missed_posts'] }}</td>
                                    <td class="abandon-{{ $participant['participant_stage_id'] }} }} center">{{ $participant['abandon'] }}</td>
                                    <td class="center">
                                        <button type="button" class="btn bg-primary btn-flat margin js--edit-relay-participant-management-stages js--add-value-id"  data-id="{{ $participant['participant_stage_id'] }}" data-toggle="modal" data-target="#myModal-Participants-Stages-Management-edit">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="stages-list"><span></span></div>
            <div class="col-lg-12 center">
            <div class="no-stages @if($participant_list_stages_count > 0) hide @else show @endif">
                <br /><h4 class="box-title">No stages added yet! It is a good idea to enroll those participants in a stage.</h4>
            </div>
            </div>
        </div>

        <div class="modal inmodal" id="myModal-Relay-Participants-Stages-delete" tabindex="-1" role="dialog" aria-hidden="true">
            {{ csrf_field() }}
            <div class="modal-dialog">
                <div class="modal-content animated flipInY">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"><i class="fa fa-exclamation-triangle text-danger"></i> Confirm Deletion </h4>
                        <small class="font-bold"></small>
                    </div>
                    <div class="modal-body">
                        <p>Please confirm this action.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <a href="#" class="btn btn-danger" id="confirm-delete">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection