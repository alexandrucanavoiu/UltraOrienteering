@extends('layouts/template')

@section('title')
    Administration of Categories - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>
                <h1 class="page-header">Administration of Categories</h1>
            </div>
            <div class="col-xs-12 col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         List of Categories
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                @if (count($categories) > 0 )
                                    <thead>
                                    <tr>
                                        <th class="center">ID</th>
                                        <th class="center">Category Name</th>
                                        <th class="center">Route</th>
                                        <th class="center"></th>
                                        <th class="center"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($categories as $category)
                                        <tr>
                                            <td class="center">{{ $category->id }}</td>
                                            <td class="center">{{ $category->name }}</td>
                                            <td class="center">{{ $category->route->name }}</td>
                                            <td class="center"><a href="{{ URL::to('/categories/edit/') }}/{{ $category->id }}"><button type="button" class="btn btn-success">Edit</button></a></td>
                                            <td class="center"><a href="{{ URL::to('/categories/remove/') }}/{{ $category->id }}"><button type="button" class="btn btn-danger">Remove</button></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                @else
                                    <div class="center">No category found in database, please add.</div>
                                @endif
                            </table>
                            <div  class="center"> {{ $categories->links() }}</div>

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
                        Add a new Category
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <form method="post" action="/categories/create">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Name of Category</label>
                                    <input name="category" id="category" class="form-control">
                                    <p class="help-block">Exemple: F18</p>
                                </div>
                                <div class="route_name">
                                    <label><strong>Route</strong></label>
                                    <select class="form-control" id="route_name" name="route_name">
                                        <option value="0">-- select --</option>
                                        @foreach($routes as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br />
                                <button id="submitbutton" type="submit" class="btn btn-primary">Add a new Category</button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>


        </div>
        <!-- /.row -->
    </div>
    <script>
            $('#submitbutton').on('click', function (e) {
                var error = false;
                var msg = "Please fill the form properly:  \n";


                if ($("#route_name").val() == 0  || !validator.isNumeric($("#route_name").val())) {
                    msg += "- Please select a route! \n";
                    error = true;
                }

                if ($("#category").val() < 3) {
                    msg += "- Please select a category! \n";
                    error = true;
                }

                if (error) {
                    alert(msg);
                    e.preventDefault();
                    return false;

                }

            });
        </script>
@endsection