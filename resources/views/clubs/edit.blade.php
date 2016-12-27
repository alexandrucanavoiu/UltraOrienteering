
@extends('layouts/template')
@section('title')
   Edit Club - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
    <div style="margin-top: 10px; margin-bottom: -10px">
        @include('partials.form-flash-message')
    </div>
    <form method="post" action="/clubs/update/{{ $club->id }}">
        {{ method_field("put") }}

        <div id="stage" class="js--stage stage-1">
            <div class="y">
<h1>Edit Club {{ $club->club_name }}</h1>
                <div class="stage_name div-left-input">
                    <div><strong>Club Name</strong></div>
                    <input class="form-control" name="name" id="clubs_name" type="text" value="{{ $club->name }}">

                </div>

                <div class="stage_date div-left-input">
                    <div><strong>City</strong></div>
                    <input class="form-control" type="text" class="city" id="city" name="city" value="{{ $club->city }}">

                </div>

                <div class="stage_time div-left-input">
                    <div><strong>District</strong></div>
                    <select class="form-control" id="district" name="district">
                            <option value="0">-- select --</option>
                        @foreach($districtlist as $item)
                            <option value="{{ $item->id }}" {{ $item->id === $club->club_district_id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>

                </div>

            </div>
        </div>
        {{ csrf_field() }}
        <button  id="submitbutton" type="submit" class="btn btn-primary">Submit</button>

    </form>
    <div class="center" ><a href="/clubs/"><button type="submit" class="btn btn-success">Back</button></a></div>
    <script>
        $('#submitbutton').on('click', function (e) {
            var error = false;
            var msg = "Please fill the form properly:  \n";


            if ($("#clubs_name").val() < 3) {
                msg += "- Club name must be between 2 and 255 characters! \n";
                error = true;
            }

            if ($("#city").val() < 3) {
                msg += "- City name must be between 2 and 255 characters! \n";
                error = true;
            }

            if ($("#district").val() == 0  || !validator.isNumeric($("#district").val())) {
                msg += "- Please select a district! \n";
                error = true;
            }

            if (error) {
                alert(msg);
                e.preventDefault();
                return false;

            }

        });
    </script>
@endsection