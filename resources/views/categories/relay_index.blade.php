@extends('layouts/template')
@section('title') Categories Administration - Ultra Orienteering Software - Open Source Software @endsection
@section('body')
    <section class="content-header">
        <h1>
            Categories
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" class="active">Categories</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <span class="pull-right">
                        <a href="#" class="btn btn-primary pull-left js--create-categories" data-toggle="modal" data-target="#myModal-Categories-create">Add a new Category</a>
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
                        <table class="categories table table-bordered">
                            <tbody>
                            <tr>
                                <th class="center">Category Name</th>
                                <th class="center" style="width: 40%">Routes</th>
                                <th class="center" style="width: 20%">Actions</th>
                            </tr>
                            @foreach($categories as $category)
                                <tr class="categories-list-{{ $category->id }}">
                                    <td class="category-name-{{ $category->id }} center">{{ $category->category_name }}</td>
                                    <td class="route-name-{{ $category->id }} center">
                                        @foreach($category->CategoryManager as $route)
                                            @if($loop->last)
                                                {{ $route->route->route_name }}
                                                @else
                                                {{ $route->route->route_name }},
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="center">
                                        <button type="button" class="btn btn-primary btn-flat margin js--edit-categories" data-id="{{ $category->id }}" data-toggle="modal" data-target="edit-categories">Edit</button>
                                        <button type="button" class="delete btn btn-danger btn-flat margin js--add-value-id" data-id="{{ $category->id }}" data-toggle="modal" data-target="#myModal-Categories-delete">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="center"><?php echo $categories->render(); ?></div>
                        <div class="no-categories @if($categories->count() > 0) hide @else show @endif"><br /><h4 class="box-title">No category added yet! It is a good idea to add a category.</h4></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

        <div class="modal inmodal" id="myModal-Categories-delete" tabindex="-1" role="dialog" aria-hidden="true">
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