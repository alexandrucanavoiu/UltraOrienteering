
@extends('layouts/template')
@section('title')
    Add a new participants - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')

    <form method="post" action="/participants/update/{{ $participant->id }}">
        {{ method_field("put") }}

        <div id="stage" class="js--stage stage-1">
            <div class="y">
                <h1>Edit participant {{ $participant->name }}</h1>
                <div class="fullname_part div-left-input">
                    <div><strong>Full Name</strong></div>
                    <input class="form-control" name="name" id="participants_name" type="text" value="{{ $participant->name }}">
                </div>

                <div class="uuid_participants div-left-input">
                    <div><strong>UUID Card</strong></div>
                    <select class="form-control" name="uuid_card_id">
                        @foreach($uuidList as $uuidCard)
                            <option value="{{ $uuidCard->id }}" {{ $uuidCard->id === $participant->uuidCard->id ? 'selected' : '' }}>NR #{{ $uuidCard->id }} - {{ $uuidCard->uuidcard }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="club_participants div-left-input">
                    <div><strong>Club</strong></div>
                    <select class="form-control" name="club_id">
                        @foreach($clubs as $club)
                            <option value="{{ $club->id }}" {{ $club->id === $participant->club->id ? 'selected' : '' }}>{{ $club->name }}</option>
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