@extends('layouts/template')
@section('title') Rankings Administration - Ultra Orienteering Software - Open Source Software @endsection
@section('body')
    <section class="content-header">
        <h1>
            Rankings
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" class="active">Rankings</a></li>
        </ol>
    </section>

    <section class="content">
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if($stages->count() > 0)
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
                                        <a class="btn btn-success btn-flat margin" data-id="{{ $stage->id }}" href="/rankings/{{ $stage->id }}/view">View Categories Rankings</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            @else
                            <div class="center">No rankings yet.</div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection