@extends('layouts/template')

@section('title')
Edit route {{ $route->name }} - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
<div class="container-fluid">
    <div class="row">


        <div class="col-lg-12">
            <div style="margin-top: 10px; margin-bottom: -10px">
                @include('partials.form-flash-message')
            </div>

            <h1 class="page-header">Edit Route {{ $route->name }}  - ID #{{ $route->id }}</h1>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Route
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <form method="post" action="/routes/update/{{ $route->id }}">
                            {{ method_field("put") }}
                            <div class="form-group route_name_edit">
                                <label>Name of Route</label>
                                <input value="{{ $route->name }}" name="name" id="route_name" class="form-control">
                                <p class="help-block">Example: LONG</p>
                            </div>
                            <div class="form-group route_length_edit">
                                <label>Length in KM</label>
                                <input value="{{ $route->length_in_km }}" name="length_in_km" id="route_length" class="form-control">
                                <p class="help-block">3 or 0,800</p>
                            </div>

                            <div class="form-group posts_nr_edit">
                                <label>Number of Posts</label>
                                <input value="{{ $route->post_amount }}" name="post_amount" id="post_nr" class="form-control">
                                <p class="help-block">Example: 5</p>
                            </div>

                            <div class="clear"></div>

                            <div class="cod_post_routes">

                                <div class="routes_cod">

                                    <div class="form-group route_length_edit">
                                        <label>Cod Post #1</label>
                                        <input value="{{ $route->post_1 }}" name="post_1" id="post_1" class="form-control">
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group route_length_edit">
                                        <label>Cod Post #2</label>
                                        <input value="{{ $route->post_2 }}" name="post_2" id="post_2" class="form-control">
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group route_length_edit">
                                        <label>Cod Post #3</label>
                                        <input value="{{ $route->post_3 }}" name="post_3" id="post_3" class="form-control">
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group route_length_edit">
                                        <label>Cod Post #4</label>
                                        <input value="{{ $route->post_4 }}" name="post_4" id="post_4" class="form-control">
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group route_length_edit">
                                        <label>Cod Post #5</label>
                                        <input value="{{ $route->post_5 }}" name="post_5" id="post_5" class="form-control">
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group route_length_edit">
                                        <label>Cod Post #6</label>
                                        <input value="{{ $route->post_6 }}" name="post_6" id="post_6" class="form-control">
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="clear">

                                        <div class="form-group route_length_edit">
                                            <label>Cod Post #7</label>
                                            <input value="{{ $route->post_7 }}" name="post_7" id="post_7" class="form-control">
                                            <p class="help-block"></p>
                                        </div>

                                        <div class="form-group route_length_edit">
                                            <label>Cod Post #8</label>
                                            <input value="{{ $route->post_8 }}" name="post_8" id="post_8" class="form-control">
                                            <p class="help-block"></p>
                                        </div>

                                        <div class="form-group route_length_edit">
                                            <label>Cod Post #9</label>
                                            <input value="{{ $route->post_9 }}" name="post_9" id="post_9" class="form-control">
                                            <p class="help-block"></p>
                                        </div>

                                        <div class="form-group route_length_edit">
                                            <label>Cod Post #10</label>
                                            <input value="{{ $route->post_10 }}" name="post_10" id="post_10" class="form-control">
                                            <p class="help-block"></p>
                                        </div>

                                        <div class="form-group route_length_edit">
                                            <label>Cod Post #11</label>
                                            <input value="{{ $route->post_11 }}" name="post_11" id="post_11" class="form-control">
                                            <p class="help-block"></p>
                                        </div>

                                        <div class="form-group route_length_edit">
                                            <label>Cod Post #12</label>
                                            <input value="{{ $route->post_12 }}"name="post_12" id="post_12" class="form-control">
                                            <p class="help-block"></p>
                                        </div>

                                    </div>

                                </div>

                                <div class="clear">
                                    {{ csrf_field() }}
                                    <button id="submitbutton" type="submit" class="btn btn-primary">Update Route</button>
                        </form>

                        <a href="/routes"> <button type="button" class="btn btn-success">BACK</button></a>
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


        if ($("#route_name").val() < 3) {
            msg += "- Route Name must be between 2 and 255 characters! \n";
            error = true;
        }

        if ($("#length_in_km").val() < 1) {
            msg += "- Length in Km! \n";
            error = true;
        }

        if ($("#post_nr").val() < 1) {
            msg += "- Numbers of posts! \n";
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