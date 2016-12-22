
@extends('layouts/template')
@section('title')
    Add a new participants - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')

    <form method="post" action="/participants/update/{{ $participants->participant_id }}">
        {{ method_field("put") }}

        <div id="stage" class="js--stage stage-1">
            <div class="y">
                <h1>Add a new participants</h1>
                <div class="fullname_part div-left-input">
                    <div><strong>Full Name</strong></div>
                    <input class="form-control" name="participants_name" id="participants_name" type="text" value="{{ $participants->participant_name }}">
                </div>

                <div class="uuid_participants div-left-input">
                    <div><strong>UUID Card</strong></div>
                    <select class="form-control" name="uuidcard_id">
                        @foreach($uuidlist as $item)
                            <option @if($item->id == $participants->uuidcards_id) selected  @endif value="{{$item->id}}">NR #{{$item->id}} - {{$item->uuidcard}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="club_participants div-left-input">
                    <div><strong>Club</strong></div>
                    <select class="form-control" name="clubs_id">
                        @foreach($clubs as $item)
                            <option @if($item->id == $participants->clubs_id) selected  @endif value="{{$item->id}}">{{$item->club_name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
        {{ csrf_field() }}
        <div class="center margin-top-30" ><button type="submit" class="btn btn-primary">Submit</button> <a href="/participants" class="btn btn-success">Back</a></div>


    </form>

@endsection