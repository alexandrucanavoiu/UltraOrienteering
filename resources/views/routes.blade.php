@extends('layouts/template')

@section('title')
    Categories Administration - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>
                <h1 class="page-header">Administration of Routes </h1>
            </div>

            <div class="button-right"><a href="/routes/add"><button type="button" class="btn btn-primary">Add a new route</button></a></div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List of Routes
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                @if (count($routes) > 0 )
                                    <thead>
                                    <tr>
                                        <th class="center">ID</th>
                                        <th class="center">Route Name</th>
                                        <th class="center">Length</th>
                                        <th class="center">P1</th>
                                        <th class="center">P2</th>
                                        <th class="center">P3</th>
                                        <th class="center">P4</th>
                                        <th class="center">P5</th>
                                        <th class="center">P6</th>
                                        <th class="center">P7</th>
                                        <th class="center">P8</th>
                                        <th class="center">P9</th>
                                        <th class="center">P10</th>
                                        <th class="center">P11</th>
                                        <th class="center">P12</th>
                                        <th class="center"></th>
                                        <th class="center"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($routes as $route)
                                        <tr>
                                            <td class="center">{{ $route->id }}</td>
                                            <td class="center">{{ $route->name }}</td>
                                            <td class="center">{{ $route->length_in_km }} km</td>
                                            <td class="center">{{ $route->post_1 }}</td>
                                            <td class="center">{{ $route->post_2 }}</td>
                                            <td class="center">{{ $route->post_3 }}</td>
                                            <td class="center">{{ $route->post_4 }}</td>
                                            <td class="center">{{ $route->post_5 }}</td>
                                            <td class="center">{{ $route->post_6 }}</td>
                                            <td class="center">{{ $route->post_7 }}</td>
                                            <td class="center">{{ $route->post_8 }}</td>
                                            <td class="center">{{ $route->post_9 }}</td>
                                            <td class="center">{{ $route->post_10 }}</td>
                                            <td class="center">{{ $route->post_11 }}</td>
                                            <td class="center">{{ $route->post_12 }}</td>
                                            <td class="center"><a href="{{ URL::to('/routes/edit/') }}/{{ $route->id }}"><button type="button" class="btn btn-success">Edit</button></a></td>
                                            <td class="center"><a href="{{ URL::to('/routes/remove/') }}/{{ $route->id }}"><button type="button" class="btn btn-danger">Remove</button></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                @else
                                    <div class="center">No routes found in database, please add.</div>
                                @endif
                            </table>
                            <div  class="center"> {{ $routes->links() }}</div>

                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <script>


        $('#submitbutton').on('click', function (e) {
            var error = false;
            var msg = "Please fill the form properly:  \n";


            if ($("#name").val() < 3) {
                msg += "- Route Name must be between 2 and 255 characters! \n";
                error = true;
            }

            if ($("#length").val() < 1) {
                msg += "- Length must be between 1 and 255 characters! \n";
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