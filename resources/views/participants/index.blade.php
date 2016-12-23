@extends('layouts/template')

@section('title') Clubs Administration - Ultra Orienteering Software - Open Source Software @endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>
                <h1 class="page-header">
                    Participants
                    <span class="pull-right">
                        <a href="{{ url('/participants/add') }}" class="btn btn-primary pull-left">Add a new Participant</a>
                    </span>
                </h1>
            </div>

            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List of Participants in database
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
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
                                    @forelse($participants as $participant)
                                        <tr>
                                            <td class="center">{{ $participant->id }}</td>
                                            <td class="center">{{ $participant->club->name }}</td>
                                            <td class="center">{{ $participant->name }}</td>
                                            <td class="center">NR #{{ $participant->uuid_card_id }} - {{ $participant->uuidCard->uuidcard }}</td>
                                            <td class="center"><a href="{{ URL::to('/participants/manage') }}/{{ $participant->id }}"><button type="button"  class="btn btn-success">Manage</button></a></td>
                                            <td class="center"><a href="{{ URL::to('/participants/edit/') }}/{{ $participant->id }}"><span class="fa fa-edit fa-fw"></span></a></td>
                                            <td class="center"><a href="{{ URL::to('/participants/remove/') }}/{{ $participant->id}}"><span class="glyphicon glyphicon-remove"></span></a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7"><div class="center">No participants in database, please add</div></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div  class="center"> {{ $participants->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="well">
            <h4>DROP ALL PARTICIPANTS FROM DATABASE</h4>
            <p>This operation will remove all data from database... WARNING !!! USE THIS BUTTON ONLY WHEN YOU WANT TO CLEAN THE SOFTWARE</p>
            <a class="btn btn-default btn-lg btn-block" href="{{ URL::to('/participants/truncate') }}">DROP ALL PARTICIPANTS FROM DATABASE</a>
        </div>
    </div>
@endsection