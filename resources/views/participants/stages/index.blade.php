@extends('layouts/template')
@section('title') Stages Administration - Ultra Orienteering Software - Open Source Software @endsection
@section('body')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="/participants">Participants</a></li>
            <li><a href="/participants/{{ $participant->id }}/stages">{{ $participant->participant_name }}</a></li>
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
                        <h3 class="widget-user-username">{{ $participant->participant_name }}</h3>
                        <h5 class="widget-user-desc">{{ $participant->club->club_name }}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="/images/orienteering.png" alt="User Avatar">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">#{{ $participant->uuidcard->id}}</h5>
                                    <span class="description-text">Number</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"> {{ $participant->uuidcard->uuid_name }}</h5>
                                    <span class="description-text">UUID CARD</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header participants-stages-count">{{ $participant_stages->count() }}</h5>
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
                        <a href="#" class="btn btn-primary pull-left js--add-value-id js--create-participants-stages"  data-id="{{ $participant->id }}" data-toggle="modal" data-target="#myModal-Participants-Stages-create">Enroll in a Stage</a>
                    </span>
                </h1>
            </div>

            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Enrolled Stages</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="participants-stages table table-bordered">
                            <tbody>
                            <tr>
                                <th class="center" style="width: 25%">Stage Name</th>
                                <th class="center" style="width: 25%">Category</th>
                                <th class="center" style="width: 10%">Total Time</th>
                                <th class="center" style="width: 10%">Missed Posts</th>
                                <th class="center" style="width: 10%">Abandon</th>
                                <th class="center" style="width: 20%">Actions</th>
                            </tr>
                            @foreach($participant_stages as $particioant_stage)
                                <tr class="participants-stages-{{ $particioant_stage->id }}">
                                    <td class="stage-name-{{ $particioant_stage->id }} center">{{ $particioant_stage->stage->stage_name }}</td>
                                    <td class="categoy-name-{{ $particioant_stage->id }} center">{{ $particioant_stage->category->category_name }}</td>
                                    <td class="total-time-{{ $particioant_stage->id }} center">{{ $particioant_stage->total_time }}</td>
                                    <td class="missed-posts-{{ $particioant_stage->id }} center">@if($particioant_stage->missed_posts == NULL ) NO @else YES @endif</td>
                                    <td class="abandon-{{ $particioant_stage->id }} center">@if($particioant_stage->abandon == 0 ) NO @else YES @endif</td>
                                    <td class="center">
                                        <button type="button" class="btn bg-primary btn-flat margin js--edit-participant-stages js--add-value-participants-stages-id js--add-value-id"  data-participants-id="{{ $particioant_stage->participants_id }}" data-stages-id="{{ $particioant_stage->stages_id }}" data-toggle="modal" data-target="#myModal-Participants-Stages-edit">Edit</button>
                                        <button type="button" class="delete btn bg-danger btn-flat margin js--add-value-participants-stages-id js--add-value-id js--add-value-participants-stages-id js--add-value-stages-id" data-id="{{ $particioant_stage->id }}" data-participants-id="{{ $particioant_stage->participants_id }}" data-stages-id="{{ $particioant_stage->stages_id }}" data-toggle="modal" data-target="#myModal-Participants-Stages-delete">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="center"><?php echo $participant_stages->render(); ?></div>
                        <div class="no-participants-stages @if($participant_stages->count() > 0) hide @else show @endif"><br /><h4 class="box-title">At this moment {{ $participant->participant_name }} isn't enrolled in any stage.</h4></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

        <div class="modal inmodal" id="myModal-Participants-Stages-delete" tabindex="-1" role="dialog" aria-hidden="true">
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