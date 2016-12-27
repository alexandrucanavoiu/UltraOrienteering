
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>

                <h1 class="page-header">Stages Administration</h1>
            </div>

            <form method="post" action="/stages/create">

            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Stages
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">

                            <script type="text/javascript">
                                $(document).ready(function() {
                                    //Input fields increment limitation
                                    var maxField = 10;

                                    //Add button selector
                                    var addButton = $('.add_button');

                                    //Input field wrapper
                                    var wrapper = $('#stage');

                                    //New input field html
                                    var fieldHTML = '<div id="stage" class="js--stage stage-1"><div class="y"><div class="stage_name div-left-input"><div><strong>Stage Name</strong></div><input name="stage_name[]" id="stage_name" type="text"></div><div class="stage1_data div-left-input"><div><strong>Date</strong></div><input type="text" class="js--stage-data" id="stage_date" name="stage_date[]"></div><div class="stage_time div-left-input"><div><strong>Start Time</strong></div><input id="stage_time" class="js--stage-time time ui-timepicker-input" autocomplete="off" name="stage_time[]" type="text"></div><div class="stage_add div-left-input"> <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div></div></div>';

                                    //Initial field counter is 1
                                    var x = 1;
                                    //Once add button is clicked
                                    $(addButton).click(function() {

                                        //Check maximum number of input fields
                                        if(x < maxField){

                                            //Increment field counter
                                            x++;

                                            // Add field html
                                            $(wrapper).append(fieldHTML);
                                        }

                                        createDatePickers();
                                        createTimePickers();
                                        validateFORM();
                                    });
                                    $(wrapper).on('click', '.remove_button', function(e) {
                                        //Once remove button is clicked
                                        e.preventDefault();

                                        //Remove field html
                                        $(this).closest('.y').remove();

                                        //Decrement field counter
                                        x--;
                                    });
                                });
                            </script>

                            <form method="post" action="/stages/create">
                            <div id="stage" class="js--stage stage-1">
                                <div class="y">
                                    <div class="stage_name div-left-input">
                                        <div><strong>Stage Name</strong></div>
                                        <input name="stage_name[]" id="stage_name" type="text" class="form-control">
                                    </div>
                                    <div class="stage_date div-left-input">
                                        <div><strong>Date</strong></div>
                                        <input type="text" class="js--stage-data form-control" id="stage_date" name="stage_date[]">
                                    </div>
                                    <div class="stage_time div-left-input">
                                        <div><strong>Start Time</strong></div>
                                        <input id="stage_time" class="js--stage-time time ui-timepicker-input form-control" autocomplete="off" name="stage_time[]" type="text">
                                    </div>
                                    <div class="stage_add div-left-input">
                                    <a href="javascript:void(0);" class="add_button" title="Add field">
                                        <img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                                        </div>
                                </div>
                            </div>
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary btn-sm btn-block" id="submitbutton">Submit</button>
                            </form>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Stages in database
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    @if (count($stageslist) > 0 )
                                        <thead>
                                        <tr>
                                            <th class="center">ID</th>
                                            <th class="stage_name center">Stage Name</th>
                                            <th class="stage_datet center">Date</th>
                                            <th class="stage_datet center">Start</th>
                                            <th class="center"></th>
                                            <th class="center"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($stageslist as $stage)
                                            <tr>
                                                <td class="center">{{ $stage->id }}</td>
                                                <td class="center">{{ $stage->name }}</td>
                                                <td class="center">{{ $stage->start_time }}</td>
                                                <td class="center">{{ $stage->duration }}</td>
                                                <td class="center"><a href="{{ URL::to('/stages/edit/') }}/{{ $stage->id }}"><button type="button" class="btn btn-success">Edit</button></a></td>
                                                <td class="center"><a href="{{ URL::to('/stages/remove/') }}/{{ $stage->id }}"><button type="button" class="btn btn-danger">Remove</button></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    @else
                                        <div class="center">No Stages in database, please add</div>
                                    @endif
                                </table>
                                <div  class="center"> {{ $stageslist->links() }}</div>
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
        function validateFORM() {
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
        }
        function createTimePickers()
        {
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
        }
        function createDatePickers()
        {
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
        }
        $(function() {
            createTimePickers();
            createDatePickers();
            validateFORM();
        });
    </script>
@endsection