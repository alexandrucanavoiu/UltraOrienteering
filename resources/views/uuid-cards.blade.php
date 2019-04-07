@extends('layouts/template')

@section('title')
    UUID Cards Administration - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>

                <h1 class="page-header">UUID Cards Administration</h1>
            </div>
            <div class="col-xs-12 col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        UUID Cards List
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                @if (count($uuidcardslist) > 0 )
                                    <thead>
                                    <tr>
                                        <th class="center">Nr. #</th>
                                        <th class="center">UUID Card</th>
                                        <th class="center"></th>
                                        <th class="center"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($uuidcardslist as $uuidcard)
                                        <tr>
                                            <td class="center">{{ $uuidcard->id }}</td>
                                            <td class="center">{{ $uuidcard->uuidcard }}</td>
                                            <td class="center"><button type="button" class="btn btn-warning disabled">Edit</button></td>
                                            <td class="center"><a href="{{ URL::to('/uuid-cards/remove/') }}/{{ $uuidcard->id }}"><button type="button" class="btn btn-danger">Remove</button></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @else
                                    <div class="center">No UUID Cards in database, please import</div>
                                @endif
                            </table>
                            <div  class="center"> {{ $uuidcardslist->links() }}</div>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
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
                                <button class="btn btn-primary btn-sm">Import File</button>
                            </form>
                        </div>
                    </div>
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
                            <div class="margin-button"><a href="{{ URL::to('/uuid-cards/downloadExcel/xls') }}"><button class="btn btn-primary btn-block btn-xs">Download Excel xls</button></a></div>
                            <div class="margin-button"><a href="{{ URL::to('/uuid-cards/downloadExcel/xlsx') }}"><button class="btn btn-primary btn-block btn-xs">Download Excel xlsx</button></a></div>
                            <div><a href="{{ URL::to('/uuid-cards/downloadExcel/csv') }}"><button class="btn btn-primary btn-block btn-xs">Download CSV</button></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Remove all data from software (reset)
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <form action="{{ URL::to('/uuid-cards/drop') }}" class="form-horizontal" method="post">
                                {{ csrf_field() }}
                                <button class="btn btn-primary btn-lg btn-block">DROP DATA</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection