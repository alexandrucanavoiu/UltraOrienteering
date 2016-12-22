
@extends('layouts/template')
@section('title')
    Edit Category - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')

    <form method="post" action="/categories/update/{{ $category->categories_id}}">
        {{ method_field("put") }}

        <div id="stage" class="js--stage stage-1">
            <div class="y">
                <h1>Edit Category {{ $category->category_name }}</h1>
                <div class="stage_name div-left-input">
                    <div><strong>Category Name</strong></div>
                    <input class="form-control" name="category_name" id="category_name" type="text" value="{{ $category->category_name }}">
                </div>

                <div class="stage_time div-left-input">
                    <div><strong>Route</strong></div>
                    <select class="form-control" name="route_name">
                        @foreach($routes as $item)
                            <option @if($item->id == $category->categories_route_name) selected  @endif value="{{$item->id}}">{{$item->route_name}}</option>
                        @endforeach
                    </select>

                </div>

            </div>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
    <div class="center" ><a href="/categories"><button type="submit" class="btn btn-success">Back</button></a></div>
@endsection