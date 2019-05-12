@extends('layouts/template')
@section('title') Stages Administration - Ultra Orienteering Software - Open Source Software @endsection
@section('body')
    <section class="content-header">
        <h1>
            Stages
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Stages</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <span class="pull-right">
                        <a href="#" class="btn btn-primary pull-left js--create-stages" data-toggle="modal" data-target="#myModal-Stages-create">  Add a new Stage</a>
                    </span>
                </h1>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="stages table table-bordered">
                            <tbody>
                            <tr>
                                <th>Stage Name</th>
                                <th class="center" style="width: 20%">Actions</th>
                            </tr>
                            @foreach($stageslist as $stage)
                            <tr class="stages-list-{{ $stage->id }}">
                                <td class="stage-name-{{ $stage->id }}">{{ $stage->stage_name }}</td>
                                <td class="center">
                                    <a class="btn btn-primary btn-flat margin js--edit-stages" data-id="{{ $stage->id }}" data-toggle="modal" data-target="edit-stages" href="#">Edit</a>
                                    <a  href="" data-id="{{ $stage->id }}" class="delete btn btn-danger btn-flat margin js--add-value-id" data-toggle="modal" data-target="#myModal-Stages-delete">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="center"><?php echo $stageslist->render(); ?></div>
                        <div class="no-stages @if($stageslist->count() > 0) hide @else show @endif"><br /><h4 class="box-title">No stage added yet! It is a good idea to add a stage.</h4></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

        <div class="modal inmodal" id="myModal-Stages-delete" tabindex="-1" role="dialog" aria-hidden="true">
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