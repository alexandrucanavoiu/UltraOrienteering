@extends('layouts/template')

@section('title') Manage Stages Administration - Ultra Orienteering Software - Open Source Software @endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>

                <h1 class="page-header">Stage Administration for {{ $participant->name }}</h1>
            </div>

            <div class="col-xs-12 col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Stages in database for {{ $participant->name }}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                @if (count($participant->participantManagers) > 0 )
                                    <thead>
                                    <tr>
                                        <th class="center">ID</th>
                                        <th class="stage_name center">Stage Name</th>
                                        <th class="center"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($participant->participantManagers as $stage)


                                        <tr>
                                            <td class="center">{{ $stage->id }}</td>
                                            <td class="center">{{ $stage->stage->name }}</td>
                                            <td class="center"><a href="{{ URL::to('/participants/') }}/{{ $participant->id }}/stages/{{ $stage->id }}/remove"><button type="button" class="btn btn-danger">Remove</button></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @else
                                    <div class="center">No Stages in database for this participant, please add</div>
                                @endif
                            </table>

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
                        Add a new Stage for this participant
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                           <div class="center"> UUUID Card Nr #{{ $participant->UuidCard->id }} - {{ $participant->UuidCard->uuidcard }}</div>
                            <form method="post" action="/participants/{{ $participant->id }}/stages/add">
                                {{ csrf_field() }}
                                <div class="stages_participant_name">
                                    <label><strong>Stage</strong></label>
                                    <select class="form-control" id="stage_name" name="name">
                                        <option value="0">-- select --</option>
                                        @foreach($stageslist as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="category_participant_name">
                                    <label><strong>Category</strong></label>
                                    <select class="form-control" id="category_name" name="category">
                                        <option value="0">-- select --</option>
                                        @foreach($category as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br />

                                <button id="submitbutton" type="submit" class="btn btn-primary">Add a new Stage</button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection