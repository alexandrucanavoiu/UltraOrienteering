
@extends('layouts/template')
@section('title')
    Clubs Administration - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>

                <h1 class="page-header">Clubs Administration</h1>
            </div>

            <script type="text/javascript">
                $(document).ready(function() {
                    //Input fields increment limitation
                    var maxField = 20;

                    //Add button selector
                    var addButton = $('.add_button');

                    //Input field wrapper
                    var wrapper = $('#stage');

                    //New input field html
                    var fieldHTML = '<div id="stage" class="js--stage stage-1"><div class="y"><div class="stage_name div-left-input"><div><strong>Club Name</strong></div><input class="form-control" name="name[]" id="clubs_name" type="text"></div><div class="stage_date div-left-input"><div><strong>City</strong></div><input class="form-control" type="text" class="city" id="city" name="city[]"></div><div class="stage_time div-left-input"> <div><strong>District</strong></div><select class="form-control" name="district[]">@foreach($districtlist as $item)<option value="{{$item->id}}">{{$item->name}}</option>@endforeach</select></div><div class="stage_add div-left-input"><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div></div></div>';

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
                        createTimePickers()
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
            <form method="post" action="/clubs/create">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Clubs
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form method="post" action="/clubs/create">
                                    <div id="stage" class="js--stage stage-1">
                                        <div class="y">

                                            <div class="stage_name div-left-input">
                                                <div><strong>Club Name</strong></div>
                                                <input class="form-control" name="name[]" id="clubs_name" type="text">

                                            </div>

                                            <div class="stage_date div-left-input">
                                                <div><strong>City</strong></div>
                                                <input class="form-control" type="text" class="city" id="city" name="city[]">

                                            </div>

                                            <div class="stage_time div-left-input">
                                                <div><strong>District</strong></div>
                                                <select class="form-control" name="district[]">
                                                @foreach($districtlist as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>

                                            <div class="stage_add div-left-input">
                                                <a href="javascript:void(0);" class="add_button" title="Add field">
                                                    <img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                                            </div>
                                        </div>
                                    </div>
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
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
                            List Clubs in database
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    @if (count($clubs) > 0 )
                                        <thead>
                                        <tr>
                                            <th class="center">ID</th>
                                            <th class="stage_name center">Club Name</th>
                                            <th class="stage_datet center">City</th>
                                            <th class="stage_datet center">District</th>
                                            <th class="center"></th>
                                            <th class="center"></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($clubs as $club)
                                            <tr>
                                                <td class="center">{{ $club->id }}</td>
                                                <td class="center">{{ $club->name }}</td>
                                                <td class="center">{{ $club->city }}</td>
                                                <td class="center">{{ $club->ClubDistrict->name }}</td>
                                                <td class="center"><a href="{{ URL::to('/clubs/edit/') }}/{{ $club->id }}"><button type="button"  data-toggle="modal" data-target="#update" class="btn btn-success">Edit</button></a></td>
                                                <td class="center"><a href="{{ URL::to('/clubs/remove/') }}/{{ $club->id }}"><button type="button" class="btn btn-danger">Remove</button></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    @else
                                        <div class="center">No Clubs in database, please add</div>
                                    @endif
                                </table>
                                <div  class="center"> {{ $clubs->links() }}</div>

                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

        </div>
        <!-- /.row -->

@endsection