@extends('layouts/template')
@section('title') Settings Administration - Ultra Orienteering Software - Open Source Software @endsection
@section('body')
    <section class="content-header">
        <h1>
            Settings
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" class="active">Settings</a></li>
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
                        <table class="settings table table-bordered">
                            <tbody>
                            <tr>
                                <th class="center">Organizer Name</th>
                                <th class="center" style="width: 40%">Type of Competition</th>
                                <th class="center" style="width: 20%">Actions</th>
                            </tr>
                                <tr class="settings-list-{{ $settings->id }}">
                                    <td class="settings-organizer-name-{{ $settings->id }} center">{{ $settings->organizer_name }}</td>
                                    <td class="settings-competition-{{ $settings->id }} center">@if($settings->competition_type == 1) Standard Competition @else Relay Competition @endif</td>
                                    <td class="center">
                                        <button type="button" class="btn btn-primary btn-flat margin js--edit-settings" data-id="{{ $settings->id }}" data-toggle="modal" data-target="edit-settings">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection