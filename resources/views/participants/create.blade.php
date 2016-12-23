@extends('layouts/template')

@section('title') Add a new participants - Ultra Orienteering Software - Open Source Software @endsection

@section('body')<div class="container-fluid">
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
    </div>
    <form method="post" action="/participants/create">
        <div id="stage" class="js--stage stage-1">
            <div class="y">
                <h1>Add a new participants</h1>
                <div class="fullname_part div-left-input">
                    <div><strong>Full Name</strong></div>
                    <input class="form-control" name="name" id="participants_name" type="text" value="">
                </div>

                <div class="uuid_participants div-left-input">
                    <div><strong>UUID Card</strong></div>
                    <select class="form-control" name="uuid_card_id">
                        <option value selected>Please select</option>
                        @foreach($uuidList as $uuidCard)
                            <option value="{{ $uuidCard->id }}">NR #{{ $uuidCard->id }} - {{ $uuidCard->uuidcard }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="club_participants div-left-input">
                    <div><strong>Club</strong></div>
                    <select class="form-control" name="club_id">
                        <option value selected>Please select</option>
                        @foreach($clubs as $club)
                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        {{ csrf_field() }}
        <div class="center margin-top-30" >
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/participants" class="btn btn-success">Back</a>
        </div>
    </form>
@endsection