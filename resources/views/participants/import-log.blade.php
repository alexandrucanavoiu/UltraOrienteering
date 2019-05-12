@extends('layouts/template')
@section('title') Import Log - Ultra Orienteering Software - Open Source Software @endsection
@section('body')
    <section class="content-header">
        <h1>
            IMPORT LOG
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" class="active">IMPORT LOG</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Upload File with time log for participants to calculate the ranking</h3>
                </div>
                    <form action="{{ URL::to('/import-log') }}"  method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="stages_id">Stage</label>
                            <select id="stages_id" name="stages_id" class="form-control">
                                <option value="">-- select --</option>
                                @foreach($stages as $stage)
                                    <option value="{{ $stage->id }}">{{ $stage->stage_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="import_file">File input</label>
                            <input type="file" type="import_file" name="import_file" id="import_file">

                            <p class="help-block">Upload the text file with the time log for participant.</p>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
                 </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-offset-3">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Journal for Stages</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="stages table table-bordered">
                            <tbody>
                            <tr>
                                <th>Stage Name</th>
                                <th class="center" style="width: 20%">Actions</th>
                            </tr>
                            @foreach($stages as $stage)
                                <tr class="stages-list-{{ $stage->id }}">
                                    <td class="stage-name-{{ $stage->id }}">{{ $stage->stage_name }}</td>
                                    <td class="center">
                                        <a target="_blank" class="btn btn-success btn-flat margin @if(empty($stage->filename)) disabled @endif" href="/{{ $stage->filename }}">Download</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
@endsection