
@extends('layouts/template')
@section('title')
    Edit Category - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
    <div style="margin-top: 10px; margin-bottom: -10px">
        @include('partials.form-flash-message')
    </div>
    <form method="post" action="/categories/update/{{ $category->id }}">
        {{ method_field("put") }}

        <div id="stage" class="js--stage stage-1">
            <div class="y">
                <h1>Edit Category {{ $category->name }}</h1>
                <div class="stage_name div-left-input">
                    <div><strong>Category Name</strong></div>
                    <input class="form-control" name="category_name" id="category_name" type="text" value="{{ $category->name }}">
                </div>

                <div class="stage_time div-left-input">
                    <div><strong>Route</strong></div>
                    <select class="form-control" name="route_name">
                        @foreach($routes as $item)
                            <option value="{{ $item->id }}" {{ $item->id === $category->route_id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>

                </div>

            </div>
        </div>
        {{ csrf_field() }}
        <button id="submitbutton"  type="submit" class="btn btn-primary">Submit</button>

    </form>
    <div class="center" ><a href="/categories"><button type="submit" class="btn btn-success">Back</button></a></div>

    <script>
        $('#submitbutton').on('click', function (e) {
            var error = false;
            var msg = "Please fill the form properly:  \n";


            if ($("#category_name").val() < 3) {
                msg += "- Category Name must be between 2 and 255 characters! \n";
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