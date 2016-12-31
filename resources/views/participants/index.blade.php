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
                        <a href="{{ route('participants.create') }}" class="btn btn-primary pull-left">Add a new Participant</a>
                    </span>
                </h1>
            </div>

            <div class="filter">
                <div class="left-filtre">Filtre by:</div>
                <form method="post" action="/participants/filter">
                    {{ csrf_field() }}
                    <div class="stage_name_filter">
                        <label><strong>Stage</strong></label>
                        <select id="stage_name_filter" name="stage_name_filter">
                            <option value="">-- select --</option>
                            @foreach($stages as $stage)
                                <option value="{{$stage->id}}">{{$stage->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="category_name_filter">
                        <label><strong>Category</strong></label>
                        <select id="category_name_filter" name="category_name_filter">
                            <option value="">-- select --</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="submit-filter"><button type="submit" class="btn btn-primary btn-xs">Filter</button></div>
                </form>
            </div>

            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List of Participants in database
                        <a target="_blank" href="/participants/import" class="btn btn-warning btn-xs float-right">Import Data</a>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center">ID</th>
                                        <th class="club_name center">Club Name</th>
                                        <th class="stage_datet center">Participant Name</th>
                                        <th class="stage_datet center">UUID Card</th>
                                        <th class="center"></th>
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
                                            <td class="center">
                                                <a href="{{ route('participants.stages.index', ['participant' => $participant->id]) }}" class="btn btn-success">Stages</a>
                                            </td>
                                            <td class="center">
                                                <a href="{{ route('participants.manage', ['participant' => $participant->id]) }}" class="btn btn-success">Manage</a>
                                            </td>
                                            <td class="center">
                                                <a href="{{ route('participants.edit', ['participant' => $participant->id]) }}" class="btn btn-link">
                                                    <span class="fa fa-edit fa-fw"></span>
                                                </a>
                                            </td>
                                            <td class="center">
                                                <form action="{{ route('participants.destroy', ['participant' => $participant->id]) }}" method="POST">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-link"><i class="fa fa-trash fa-fw"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8"><div class="center">No participants in database, please add</div></td>
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
    </div>
@endsection