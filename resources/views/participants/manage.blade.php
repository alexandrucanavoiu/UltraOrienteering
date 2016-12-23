@extends('layouts/template')

@section('title') Management - Ultra Orienteering Software - Open Source Software @endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @if(Session::has('message'))
                    <p>{!!   Session::get('message') !!}</p>
                @endif

                @if (count($errors) > 0 )

                    @foreach($errors->all() as $error)
                        <div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> {{ $error }}  </div>
                    @endforeach

                @endif

                <h1 class="page-header">Stages Administration for {{ $participant->name }}</h1>
            </div>
            <form method="post" action="/participants/manage/update">
                @forelse($participant->participantManagers as $manager )
                    <div class="col-lg-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Stage {{ $manager->stage->name  }}
                            </div>
                            <input type="hidden" class="hidden-val" name="participant_id[]" value="{{ $participant->id }}">
                            <input type="hidden" class="hidden-val" name="uuidcards_id[]" value="{{ $participant->uuid_card_id }}">
                            <input type="hidden" class="hidden-val" name="stage_name[]" value="{{ $manager->stage_id }}">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Category</label>

                                    <select class="form-control" name="participant_category[]">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id === $manager->category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label>UUID Card: </label>
                                    {{ $manager->uuidCard->uuidcard }}
                                </div>

                                <div class="posts">
                                    <span>Start</span>
                                    <input class="form-control posts_time_input" name="post_start[]" id="post_start"  type="text" value="{{ $manager->post_start }}">
                                </div>

                                <div class="posts">
                                    <span>Post #1</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_1[]" id="post_1"  type="text" value="{{ $manager->post_1 }}">
                                </div>

                                <div class="posts">
                                    <span>Post #2</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_2[]" id="post_2"  type="text" value="{{ $manager->post_2 }}">
                                </div>

                                <div class="posts">
                                    <span>Post #3</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_3[]" id="post_3"  type="text" value="{{ $manager->post_3 }}">
                                </div>

                                <div class="posts">
                                    <span>Post #4</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_4[]" id="post_4"  type="text" value="{{ $manager->post_4 }}">
                                </div>

                                <div class="posts">
                                    <span>Post #5</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_5[]" id="post_5"  type="text" value="{{ $manager->post_5 }}">
                                </div>

                                <div class="posts">
                                    <span>Post #6</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_6[]" id="post_6"  type="text" value="{{ $manager->post_6 }}">
                                </div>

                                <div class="posts">
                                    <span>Post #7</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_7[]" id="post_7"  type="text" value="{{ $manager->post_7 }}">
                                </div>

                                <div class="posts">
                                    <span>Post #8</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_8[]" id="post_8"  type="text" value="{{ $manager->post_8 }}">
                                </div>

                                <div class="posts">
                                    <span>Post #9</span>
                                    <input class="form-control posts_time_input posts_time_input_1" name="post_9[]" id="post_9"  type="text" value="{{ $manager->post_9 }}">
                                </div>

                                <div class="posts">
                                    <span>Post #10</span>
                                    <input class="form-control posts_time_input " name="post_10[]" id="post_10"  type="text" value="{{ $manager->post_10 }}">
                                </div>

                                <div class="posts">
                                    <span>Post #11</span>
                                    <input class="form-control posts_time_input" name="post_11[]" id="post_11"  type="text" value="{{ $manager->post_11 }}">
                                </div>

                                <div class="posts">
                                    <span>Post #12</span>
                                    <input class="form-control posts_time_input" name="post_12[]" id="post_12"  type="text" value="{{ $manager->post_12 }}">
                                </div>

                                <div class="posts">
                                    <span>Finish</span>
                                    <input class="form-control posts_time_input" name="post_finish[]" id="post_finish"  type="text" value="{{ $manager->post_finish }}">
                                </div>
                            </div>
                            <div class="panel-footer"></div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 center">Currently there are no stages!</div>
                @endforelse
                <div class="clear"></div>

                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary ">Submit</button>
            </form>
        </div>
    </div>
@endsection