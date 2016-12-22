@extends('layouts/template')

@section('title')
    Add a new route - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">


            <div class="col-lg-12">
                <br />
                @if(Session::has('message'))

                    {!!   Session::get('message') !!}
                @endif

                @if (count($errors) > 0 )

                    @foreach($errors->all() as $error)
                        <div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> {{ $error }}  </div>
                    @endforeach

                @endif

                <h1 class="page-header">Add a new Route</h1>
            </div>



            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add a new Route
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <form method="post" action="/routes/create">
                                {{ csrf_field() }}


                                <div class="form-group route_name_edit">
                                    <label>Name of Route</label>
                                    <input name="route_name" id="route_name" class="form-control">
                                    <p class="help-block">Example: LONG</p>
                                </div>


                                <div class="form-group route_length_edit">
                                    <label>Length in KM</label>
                                    <input name="route_length" id="route_length" class="form-control">
                                    <p class="help-block">3 or 0,800</p>
                                </div>

                                <div class="form-group posts_nr_edit">
                                    <label>Number of Posts</label>
                                    <input name="post_nr" id="post_nr" class="form-control">
                                    <p class="help-block">Example: 6</p>
                                </div>


                                <div class="clear"></div>

                                <div class="cod_post_routes">

                                    <div class="routes_cod">

                                <div class="form-group route_length_edit">
                                    <label>Cod Post #1</label>
                                    <input name="post_1" id="post_1" class="form-control">
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group route_length_edit">
                                    <label>Cod Post #2</label>
                                    <input name="post_2" id="post_2" class="form-control">
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group route_length_edit">
                                    <label>Cod Post #3</label>
                                    <input name="post_3" id="post_3" class="form-control">
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group route_length_edit">
                                    <label>Cod Post #4</label>
                                    <input name="post_4" id="post_4" class="form-control">
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group route_length_edit">
                                    <label>Cod Post #5</label>
                                    <input name="post_5" id="post_5" class="form-control">
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group route_length_edit">
                                    <label>Cod Post #6</label>
                                    <input name="post_6" id="post_6" class="form-control">
                                    <p class="help-block"></p>
                                </div>

                                <div class="clear">


                                    <div class="form-group route_length_edit">
                                        <label>Cod Post #7</label>
                                        <input name="post_7" id="post_7" class="form-control">
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group route_length_edit">
                                        <label>Cod Post #8</label>
                                        <input name="post_8" id="post_8" class="form-control">
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group route_length_edit">
                                        <label>Cod Post #9</label>
                                        <input name="post_9" id="post_9" class="form-control">
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group route_length_edit">
                                        <label>Cod Post #10</label>
                                        <input name="post_10" id="post_10" class="form-control">
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group route_length_edit">
                                        <label>Cod Post #11</label>
                                        <input name="post_11" id="post_11" class="form-control">
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group route_length_edit">
                                        <label>Cod Post #12</label>
                                        <input name="post_12" id="post_12" class="form-control">
                                        <p class="help-block"></p>
                                    </div>

                                </div>

                                    </div>

                                    <div class="clear">

                                <button id="submitbutton" type="submit" class="btn btn-primary">Add a new Route</button>
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