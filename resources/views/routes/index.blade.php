@extends('layouts/template')
@section('title') Routes Administration - Ultra Orienteering Software - Open Source Software @endsection
@section('body')
    <section class="content-header">
        <h1>
            Routes
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" class="active">Routes</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <span class="pull-right">
                        <a href="#" class="btn btn-primary pull-left js--create-routes" data-toggle="modal" data-target="#myModal-Routes-create">Add a new Route</a>
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
                        <table class="routes table table-bordered">
                            <tbody>
                            <tr>
                                <th>Route Name</th>
                                <th class="center" style="width: 20%">Manage</th>
                                <th class="center" style="width: 20%">Actions</th>
                            </tr>
                            @foreach($routes as $route)
                            <tr class="routes-list-{{ $route->id }}">
                                <td class="route-name-{{ $route->id }}">{{ $route->route_name }}</td>
                                <td class="route-check-points-{{ $route->id }} center"><button type="button" class="btn bg-olive btn-flat margin check-point-manager" data-id="{{ $route->id }}" data-toggle="modal" data-target="#myModal-Route-Manager">Check Points</button></td>
                                <td class="center">
                                    <button type="button" class="btn btn-primary btn-flat margin js--edit-routes" data-id="{{ $route->id }}" data-toggle="modal" data-target="edit-routes">Edit</button>
                                    <button type="button" class="delete btn btn-danger btn-flat margin js--add-value-id" data-id="{{ $route->id }}" data-toggle="modal" data-target="#myModal-Routes-delete">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="center"><?php echo $routes->render(); ?></div>
                        <div class="no-routes @if($routes->count() > 0) hide @else show @endif"><br /><h4 class="box-title">No route added yet! It is a good idea to add a route.</h4></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

        <div class="modal inmodal" id="myModal-Routes-delete" tabindex="-1" role="dialog" aria-hidden="true">
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