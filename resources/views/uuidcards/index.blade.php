@extends('layouts/template')

@section('title')
    UUID Cards Administration - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
    <section class="content-header">
        <h1>
            UUID Cards
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Uuid Cards</a></li>
        </ol>
    </section>
    <section class="content">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-8">
                <div class="box">
                    <div class="box-body">
                        @if($uuidcards->count() > 0)
                            <table id="UUID-cards-list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>UUID CARD</th>
                                    <th class="center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Number</th>
                                    <th>UUID CARD</th>
                                    <th class="center">Actions</th>
                                </tr>
                                </tfoot>
                            </table>
                        @else
                            <div class="no-uuid-cards show"><span><h4 class="box-title">No UUID CARDS added yet!</h4>It is a good idea to add some UUID CARDS.</span></div>
                        @endif
                        <div class="no-uuid-cards hide"><span><h4 class="box-title">No UUID CARDS added yet!</h4>It is a good idea to add some UUID CARDS.</span></div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Download UUID Cards from Database
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="margin-button"><a href="{{ URL::to('/uuid-cards/downloadExcel/xls') }}"><button class="btn btn-block btn-success">Download Excel xls</button></a></div>
                            <br />
                            <div class="margin-button"><a href="{{ URL::to('/uuid-cards/downloadExcel/xlsx') }}"><button class="btn btn-block btn-success">Download Excel xlsx</button></a></div>
                            <br />
                            <div><a href="{{ URL::to('/uuid-cards/downloadExcel/csv') }}"><button class="btn btn-block btn-success">Download CSV</button></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Upload UUID Cards from xls, xlsx, csv
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <form action="{{ URL::to('/uuid-cards/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div><input type="file" name="import_file" /></div>
                                <br />
                                <button class="btn btn-primary btn-sm">Import File</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Delete all UUID CARDS
                    </div>
                    <div class="panel-body">
                        <button type="button" class="btn btn-block btn-danger btn-lg" data-toggle="modal" data-target="#myModal-UUID-Cards-drop">CLEAN</button>
                    </div>
                </div>
            </div>


        </div>
        <div class="modal inmodal" id="myModal-UUID-Cards-drop" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <a href="#" class="btn btn-danger" id="confirm-delete">Agree</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts-footer')
    <script>
        $(function() {
            $('#UUID-cards-list').DataTable({
                'columnDefs': [
                    {className: "center", targets: [0,2]},
                ],
                'pageLength': 10,
                'processing': true,
                'serverSide': true,
                'searching'   : true,
                ajax: '{!! route('uuid-cards.all') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'uuid_name', name: "uuid_name", className: 'center',
                        "render": function (data, type, row, meta) {
                            return '<div class="uuid-cards-'+ row.id +'">#'+ row.id +' ('+row.uuid_name+')</div>';
                        }
                    },
                    { data: 'id', name: 'id',
                        "render": function (data, full) {
                            return '<a class="btn btn-primary btn-flat margin js--edit-uuid-cards" data-id="'+ data +'" data-toggle="modal" data-target="edit-uuid-cards" href="#">Edit</a>';
                        }
                    }
                ],
            });
        });
    </script>
@endsection