
@extends('layouts/template')
@section('scripts-header')
    <script src="/vendor/jquery/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="/vendor/jquery/jquery.timepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="/vendor/jquery/jquery.timepicker.css" />
    <script type="text/javascript" src="/vendor/jquery/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="/vendor/jquery/bootstrap-datepicker.css" />
@endsection
@section('title')
    Stages Administration - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')




        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Stage {{ $stage->stage_name }}
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">

                        <form  method="post" action="/stages/update/{{ $stage->id }}">
                            {{ method_field("put") }}

                            <div id="stage" class="js--stage stage-1">
                                <div class="y">

                                    <div class="stage_name div-left-input">
                                        <div><strong>Stage Name</strong></div>
                                        <input class="form-control" name="stage_name" id="stage_name" type="text" value="{{ $stage->stage_name }}">

                                    </div>

                                    <div class="stage_date div-left-input">
                                        <div><strong>Date</strong></div>
                                        <input type="text" class="form-control js--stage-data" id="stage_date" name="stage_date" value="{{ $stage->stage_date}}">

                                    </div>

                                    <div class="stage_time div-left-input resize-time">
                                        <div><strong>Start Time</strong></div>
                                        <input class="form-control js--stage-time time ui-timepicker-input" autocomplete="off" name="stage_time" type="text" value="{{ $stage->stage_time }}">

                                    </div>

                                </div>
                            </div>
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary btn-sm btn-block" id="submitbutton">Update Stage</button>
                        </form>


                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>



        </div>



    <script>


            $('#submitbutton').on('click', function (e) {
                var error = false;
                var msg = "Please fill the form properly:  \n";


                if ($("#stage_name").val() < 3) {
                    msg += "- Stage Name must be between 3 and 255 characters! \n";
                    error = true;
                }

                if ($("#stage_date").val() < 1) {
                    msg += "- Please select a date! \n";
                    error = true;
                }

                if ($("#stage_time").val() < 1) {
                    msg += "- Please select a time! \n";
                    error = true;
                }


                if (error) {
                    alert(msg);
                    e.preventDefault();
                    return false;

                }

            });

            $(function() {


            $('.js--stage-time').each(function () {



                $(this).timepicker({ 'step': 1 });

                $(this).timepicker({ 'step': 1 });
                $(this).timepicker({
                    'timeFormat': 'H:i:s',
                    'step': function(i) {
                        return (i%2) ? 1 : 1;
                    }
                });


            });


            $('.js--stage-data').each(function () {



                $(this).datepicker({
                            dateFormat: "dd-mm-yy",
                        }

                );
                $.datepicker.setDefaults({minDate: new Date()});
                $(this).datepicker({onSelect: function(selectedDate) {
                    var date = $(this).datepicker('getDate');
                    if (date) {
                        date.setDate(date.getDate() + 1);
                    }

                }});

            });


        });




    </script>

@endsection