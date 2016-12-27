@extends('layouts/template')

@section('title') Add a new participants - Ultra Orienteering Software - Open Source Software @endsection

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div style="margin-top: 10px; margin-bottom: -10px">
                @include('partials.form-flash-message')
            </div>
        </div>
    </div>

    <form method="post" action="{{ route('participants.store') }}">
        <div id="stage" class="js--stage stage-1">
            <div class="y">
                <h1>Add a new participants</h1>
                <div class="fullname_part div-left-input">
                    <label for="participants_name">Full Name</label>
                    <input class="form-control" name="name" id="participants_name" type="text" value="">
                </div>

                <div class="uuid_participants div-left-input">
                    <label for="uuid_card_id">UUID Card</label>
                    <select class="form-control" id="uuid_card_id" name="uuid_card_id">
                        <option value selected>Please select</option>
                        @foreach($uuidList as $uuidCard)
                            <option value="{{ $uuidCard->id }}">NR #{{ $uuidCard->id }} - {{ $uuidCard->uuidcard }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="club_participants div-left-input">
                    <label for="club_id">Club</label>
                    <select class="form-control" id="club_id" name="club_id">
                        <option value selected>Please select</option>
                        @foreach($clubs as $club)
                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="center margin-top-30" >
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('participants.index') }}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
@endsection