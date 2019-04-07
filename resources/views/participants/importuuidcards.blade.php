@extends('layouts/template')

@section('title') Import Administration - Ultra Orienteering Software - Open Source Software @endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>
                <h1 class="page-header">
                    Import TIME for Participants based on UUID CARDS
                    <span class="float-right">
                        <a href="{{ route('participants.create') }}" class="btn btn-primary pull-left">Add a new Participant</a>
                    </span>
                    <span class="float-right">
                        <a href="/participants" class="btn btn-success">Back</a>
                    </span>
                </h1>
            </div>

            <div class="col-xs-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Upload UUID Cards from csv
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <form action="/participants/import/xls" class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="stages">
                                    <label><strong>Stages</strong></label>
                                    <select class="form-control" id="stages" name="stages">
                                        <option value="0">-- select --</option>
                                        @foreach($stages as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div><input type="file" name="import_file" /></div>
                                <button class="btn btn-primary btn-sm">Import File</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection