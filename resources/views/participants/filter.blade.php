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
                    Filter for Stage {{ $stage->name }} - Category {{ $category->name }}
                    <span class="float-right">
                        <a href="{{ route('participants.create') }}" class="btn btn-primary pull-left">Add a new Participant</a>
                    </span>
                    <span class="float-right">
                        <a href="/participants" class="btn btn-success">Back</a>
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
                            @foreach($stages as $stage)
                                <option @if($id_stage == $stage->id) selected @endif value="{{$stage->id}}">{{$stage->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="category_name_filter">
                        <label><strong>Category</strong></label>
                        <select id="category_name_filter" name="category_name_filter">
                            @foreach($categories as $category)
                                <option @if($id_category == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
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
                        <a target="_blank" href="/participants/filter/{{ $id_stage }}/{{ $id_category }}/export/pdf" class="btn btn-warning btn-xs float-right">Export to PDF</a>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="club_name center">Club Name</th>
                                    <th class="stage_datet center">Participant Name</th>
                                    <th class="stage_datet center">UUID Card</th>
                                    <th class="stage_datet center">Category</th>
                                    <th class="stage_datet center"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($participants as $participant)
                                    <tr>
                                        <td class="center">{{ $participant->participant->club->name }}</td>
                                        <td class="center">{{ $participant->participant->name }}</td>
                                        <td class="center">NR #{{ $participant->participant->uuid_card_id }} - {{ $participant->uuidCard->uuidcard }}</td>
                                        <td class="center">{{ $participant->category->name }}</td>
                                        <td class="center">
                                            <a href="{{ route('participants.stages.index', ['participant' => $participant->id]) }}" class="btn-filter btn-link"><span class="fa fa-space-shuttle fa-fw"></span></a>
                                            <a href="{{ route('participants.manage', ['participant' => $participant->id]) }}" class="btn-filter btn-link"><span class="fa fa-sitemap fa-fw"></span></a>
                                            <a href="{{ route('participants.edit', ['participant' => $participant->id]) }}" class="btn-filter btn-link"><span class="fa fa-edit fa-fw"></span></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8"><div class="center">No participants in database, please add</div></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection