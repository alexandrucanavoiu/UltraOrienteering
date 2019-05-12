@extends('layouts/template')
@section('title') Clubs Administration - Ultra Orienteering Software - Open Source Software @endsection
@section('body')
    <section class="content-header">
        <h1>
            Clubs
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" class="active">Clubs</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <span class="pull-right">
                        <a href="#" class="btn btn-primary pull-left js--create-clubs" data-toggle="modal" data-target="#myModal-Clubs-create">Add a new Club</a>
                    </span>
                </h1>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-body">
                        <table id="clubs-list" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Club Name</th>
                                <th>City</th>
                                <th class="center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="no-clubs @if($clubs->count() > 0) hide @else show @endif"><h4 class="box-title">No club added yet! It is a good idea to add a club.</h4></div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

        <div class="modal inmodal" id="myModal-Clubs-delete" tabindex="-1" role="dialog" aria-hidden="true">
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
            $('#clubs-list').DataTable({
                'columnDefs': [
                    {className: "center", targets: [1,2]},
                    { "width": "60%", "targets": 0 },
                    { "width": "20%", "targets": 1 },
                    { "width": "20%", "targets": 2 },
                ],
                'pageLength': 25,
                'processing': true,
                'serverSide': true,
                'searching'   : true,
                ajax: '{!! route('clubs.all') !!}',
                columns: [
                    { data: 'club_name', name: "club_name",
                        "render": function (data, type, row, meta) {
                            return '<div class="club-name-'+ row.id +'">'+data+'</div>';
                        }
                    },
                    { data: 'city', name: "city", className: 'center',
                        "render": function (data, type, row, meta) {
                            return '<div class="city-'+ row.id +'">'+data+'</div>';
                        }
                    },
                    { data: 'id', name: 'id',
                        "render": function (data, full) {
                            return '<a class="btn bg-primary btn-flat margin js--edit-clubs" data-id="'+ data +'" data-toggle="modal" data-target="edit-clubs" href="#">Edit</a> <a  href="" data-id="'+data+'" class="delete btn btn-danger btn-flat margin js--add-value-id" data-toggle="modal" data-target="#myModal-Clubs-delete">Delete</a>';
                        }
                    }
                ],
            });
        });
    </script>
@endsection