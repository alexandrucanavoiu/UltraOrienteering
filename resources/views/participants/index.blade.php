@extends('layouts/template')
@section('title') Clubs Administration - Ultra Orienteering Software - Open Source Software @endsection
@section('body')
    <section class="content-header">
        <h1>
            Participants
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="#">Participants</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <span class="pull-right">
                        <a href="#" class="btn btn-primary pull-left js--create-participants" data-toggle="modal" data-target="#myModal-Participants-create">Add a new Participant</a>
                    </span>
                </h1>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-body">
                            <table id="participants-list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Participant Name</th>
                                    <th>UUID Card</th>
                                    <th>Club</th>
                                    <th></th>
                                    <th class="center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        <div class="no-participants @if($participants->count() > 0) hide @else show @endif"><h4 class="box-title">No participant added yet! It is a good idea to add a participant.</h4></div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

        <div class="modal inmodal" id="myModal-Participants-delete" tabindex="-1" role="dialog" aria-hidden="true">
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

@section('scripts-footer')
    <script>
        $(function() {
            $('#participants-list').DataTable({
                'columnDefs': [
                    {className: "center", targets: [1,3,4]},
                    { "width": "25%", "targets": 0 },
                    { "width": "10%", "targets": 1 },
                    { "width": "25%", "targets": 3 },
                    { "width": "20%", "targets": 3 },
                    { "width": "15%", "targets": 4 },
                    { "orderable": false, "targets": [2, 3, 4]}
                ],
                'pageLength': 25,
                'processing': true,
                'serverSide': true,
                'searching'   : true,
                ajax: '{!! route('participants.all') !!}',
                columns: [
                    { data: 'participant_name', name: "participant_name",
                        "render": function (data, type, row, meta) {
                            return '<div class="participant-name-'+ row.id +'">'+data+'</div>';
                        }
                    },
                    { data: 'uuidcard.uuid_name', name: "uuidcard.uuid_name", className: 'center',
                        "render": function (data, type, row, meta) {
                            return '<div class="participant-uuid-'+ row.id +'">#'+ row.uuidcard.id +' ('+row.uuidcard.uuid_name+')</div>';
                        }
                    },
                    { data: 'club.name', name: "club.name", className: 'center',
                        "render": function (data, type, row, meta) {
                            return '<div class="participant-club-'+ row.id +'">'+row.club.club_name+'</div>';
                        }
                    },
                    { data: 'id', name: "id", className: 'center',
                        "render": function (data, type, row, meta) {
                            return '<a href="/participants/'+data+'/stages" class="btn bg-olive btn-flat margin">Manage Stages</a>';
                        }
                    },
                    { data: 'id', name: 'id',
                        "render": function (data, full) {
                            return '<a class="btn bg-primary btn-flat margin js--edit-participants" data-id="'+ data +'" data-toggle="modal" data-target="edit-participants" href="#">Edit</a> <a  href="" data-id="'+data+'" class="delete btn btn-danger btn-flat margin js--add-value-id" data-toggle="modal" data-target="#myModal-Participants-delete">Delete</a>';
                        }
                    }
                ],
            });
        });
    </script>
@endsection