
@extends('layouts/template')
@section('title')
    Management - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <br />
                @if(Session::has('message'))

                    {!!   Session::get('message') !!}
                @endif

                @if (count($errors) > 0 )

                    @foreach($errors->all() as $error)
                        <div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> {{ $error }}  </div>
                    @endforeach

                @endif

                <h1 class="page-header">Stages Administration for {{ $participants->participant_name }}</h1>
            </div>

<?php $participants_per_stage = array(); ?>
@foreach($participants_manage as $participants_stages)
    <?php $participants_per_stage[$participants_stages->stages_name] = $participants_stages->categories_id; ?>
@endforeach



            <form method="post" action="/participants/manage/update">

                    @foreach($stages as $stage )

                    <div class="col-lg-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Stage {{ $stage->stage_name  }}
                            </div>

                            <input class="hidden-val" name="participant_id[]" value="{{ $participants->participant_id }}" type="hidden">
                            <input class="hidden-val" name="uuidcards_id[]" value="{{ $participants->uuidcards_id }}" type="hidden">
                            <input class="hidden-val" name="stage_name[]" value="{{ $stage->id }}" type="hidden">
                            <div class="panel-body">
                                <div>
                                <label>Category</label>

                                <select class="form-control" name="participant_category[]">
                                    @foreach($category as $key => $item)
                                        <option @if(isset($participants_per_stage[$stage->id]) && $item->id == $participants_per_stage[$stage->id])selected @endif value="{{$item->id}}">{{$item->category_name}}</option>
                                    @endforeach
                                </select>
                                </div>
                                <br />
                                <div>
                                <label>UUID Card: </label>
                                {{ $participants->uuidcards_uuidcard_name }}
                                </div>


                                <div class="posts">
                                    <span>Start</span>
                                    <input class="form-control posts_time_input" name="post_s" id="post_s"  type="text" value="">
                                </div>

                                <div class="posts">
                                    <span>Post #1</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_1" id="post_1"  type="text" value="">
                                </div>

                                <div class="posts">
                                    <span>Post #2</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_2" id="post_2"  type="text" value="">
                                </div>

                                <div class="posts">
                                    <span>Post #3</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_3" id="post_3"  type="text" value="">
                                </div>

                                <div class="posts">
                                    <span>Post #4</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_4" id="post_4"  type="text" value="">
                                </div>

                                <div class="posts">
                                    <span>Post #5</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_5" id="post_5"  type="text" value="">
                                </div>

                                <div class="posts">
                                    <span>Post #6</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_6" id="post_6"  type="text" value="">
                                </div>

                                <div class="posts">
                                    <span>Post #7</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_7" id="post_7"  type="text" value="">
                                </div>

                                <div class="posts">
                                    <span>Post #8</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_8" id="post_8"  type="text" value="">
                                </div>

                                <div class="posts">
                                    <span>Post #9</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_9" id="post_9"  type="text" value="">
                                </div>

                                <div class="posts">
                                    <span>Post #10</span>
                                    <input class="form-control posts_time_input " name="post_10" id="post_10"  type="text" value="">
                                </div>

                                <div class="posts">
                                    <span>Post #11</span>
                                    <input class="form-control posts_time_input" name="post_11" id="post_11"  type="text" value="">
                                </div>

                                <div class="posts">
                                    <span>Post #12</span>
                                    <input class="form-control posts_time_input" name="post_12" id="post_12"  type="text" value="">
                                </div>

                                <div class="posts">
                                    <span>Finish</span>
                                    <input class="form-control posts_time_input" name="post_f" id="post_f"  type="text" value="">
                                </div>

                              
                            </div>
                            <div class="panel-footer">


                            </div>
                        </div>
                    </div>

                    @endforeach

                    <div class="clear"></div>

                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary ">Submit</button>

                </form>





        </div>



@endsection