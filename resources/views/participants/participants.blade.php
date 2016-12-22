
@extends('layouts/template')
@section('title')
    Clubs Administration - Ultra Orienteering Software - Open Source Software
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

                <h1 class="page-header">Participants</h1>
            </div>

            <div class="button-right"> <a href="{{ URL::to('/participants/add') }}"><button type="button" class="btn btn-primary">Add a new Participant</button></a></div>

                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List of Participants in database
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    @if (count($participants) > 0 )
                                        <thead>
                                        <tr>
                                            <th class="center">ID</th>
                                            <th class="stage_name center">Club Name</th>
                                            <th class="stage_datet center">Participant Name</th>
                                            <th class="stage_datet center">UUID Card</th>
                                            <th class="center"></th>
                                            <th class="center"></th>
                                            <th class="center"></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($participants as $participant)
                                            <tr>
                                                <td class="center">{{ $participant->participant_id }}</td>
                                                <td class="center">{{ $participant->club_name }}</td>
                                                <td class="center">{{ $participant->participant_name }}</td>
                                                <td class="center">NR #{{ $participant->uuidcards_id }} - {{ $participant->uuidcards_uuidcard_name }}</td>
                                                <td class="center"><a href="{{ URL::to('/participants/manage') }}/{{ $participant->participant_id }}"><button type="button"  class="btn btn-success">Manage</button></a></td>
                                                <td class="center"><a href="{{ URL::to('/participants/edit/') }}/{{ $participant->participant_id }}"><span class="fa fa-edit fa-fw"></span></a></td>
                                                <td class="center"><a href="{{ URL::to('/participants/remove/') }}/{{ $participant->participant_id}}"><span class="glyphicon glyphicon-remove"></span></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    @else
                                        <div class="center">No participants in database, please add</div>
                                    @endif
                                </table>
                                <div  class="center"> {{ $participants->links() }}</div>

                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

        </div>
        <!-- /.row -->
        <div class="well">
            <h4>DROP ALL PARTICIPANTS FROM DATABASE</h4>
            <p>This operation will remove all data from database... WARNING !!! USE THIS BUTTON ONLY WHEN YOU WANT TO CLEAN THE SOFTWARE</p>
            <a class="btn btn-default btn-lg btn-block" href="{{ URL::to('/participants/truncate') }}">DROP ALL PARTICIPANTS FROM DATABASE</a>
        </div>
    </div>


@endsection