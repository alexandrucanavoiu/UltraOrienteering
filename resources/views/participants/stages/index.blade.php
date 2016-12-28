@extends('layouts.template')

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

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center">ID</th>
                                        <th class="stage_name center">Stage Name</th>
                                        <th class="center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($participant->participantManagers as $stage)
                                        <tr>
                                            <td class="center">{{ $stage->id }}</td>
                                            <td class="center">{{ $stage->stage->name }}</td>
                                            <td class="center">
                                                <form action="{{ route('participants.stages.destroy', ['participant' => $participant->id, 'stage' => $stage->id]) }}" method="POST">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-link"><i class="fa fa-trash fa-fw"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="center">Currently there are no stages for this Participant. Please add a stage.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add a new Stage for this participant
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="center">UUUID Card Nr #{{ $participant->UuidCard->id }} - {{ $participant->UuidCard->uuidcard }}</div>
                            <form method="post" action="{{ route('participants.stages.store', ['participant' => $participant->id]) }}">
                                {{ csrf_field() }}
                                <div class="stages_participant_name form-group">
                                    <label for="stage_id">Stage</label>
                                    <select class="form-control" id="stage_id" name="stage_id">
                                        <option value selected>Please select</option>
                                        @foreach($stages as $stage)
                                            <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="category_participant_name form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <option value selected>Please select</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button id="submitbutton" type="submit" class="btn btn-primary">Add a new Stage</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="center">
                <a href="{{ route('participants.index') }}" class="btn btn-danger">Back</a>
            </div>

        </div>
    </div>
@endsection