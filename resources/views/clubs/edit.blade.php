
@extends('layouts/template')
@section('title')
   Edit Club - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')

    <form method="post" action="/clubs/update/{{ $clubs->club_id }}">
        {{ method_field("put") }}

        <div id="stage" class="js--stage stage-1">
            <div class="y">
<h1>Edit Club {{ $clubs->club_name }}</h1>
                <div class="stage_name div-left-input">
                    <div><strong>Club Name</strong></div>
                    <input class="form-control" name="name" id="clubs_name" type="text" value="{{ $clubs->club_name }}">

                </div>

                <div class="stage_date div-left-input">
                    <div><strong>City</strong></div>
                    <input class="form-control" type="text" class="city" id="city" name="city" value="{{ $clubs->club_city }}">

                </div>

                <div class="stage_time div-left-input">
                    <div><strong>District</strong></div>
                    <select class="form-control" name="district">
                        @foreach($districtlist as $item)
                            <option @if($item->id == $clubs->club_district) selected  @endif value="{{$item->id}}">{{$item->district_name}}</option>
                        @endforeach
                    </select>

                </div>

            </div>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
    <div class="center" ><a href="/clubs/"><button type="submit" class="btn btn-success">Back</button></a></div>
@endsection