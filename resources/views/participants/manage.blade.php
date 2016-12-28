@extends('layouts/template')

@section('title') Management - Ultra Orienteering Software - Open Source Software @endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>

                <h1 class="page-header">Stages Administration for {{ $participant->name }}</h1>
            </div>
            <form action="{{ route('participants.manage', ['participant' => $participant->id]) }}" method="POST">
                {{ method_field('PUT') }}

                @forelse($participant->participantManagers as $manager )
                    <div class="col-lg-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Stage {{ $manager->stage->name  }}
                            </div>

                            {{-- The following does not seem to add functions and only adds danger --}}
                            {{--<input type="hidden" class="hidden-val" name="participant_id[]" value="{{ $participant->id }}">--}}
                            {{--<input type="hidden" class="hidden-val" name="uuidcards_id[]" value="{{ $participant->uuid_card_id }}">--}}
                            {{--<input type="hidden" class="hidden-val" name="stage_name[]" value="{{ $manager->stage_id }}">--}}

                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="manage[{{ $manager->id }}][category_id]">Category</label>
                                    <select class="form-control" id="manage[{{ $manager->id }}][category_id]"
                                            name="manage[{{ $manager->id }}][category_id]">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id === $manager->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <strong>UUID Card: </strong>
                                    {{ $manager->uuidCard->uuidcard }}
                                </div>

                                <div class="posts clearfix">
                                    <label class="pull-left" for="manage[{{ $manager->id }}][post_start]">Start</label>
                                    <input class="form-control posts_time_input" name="manage[{{ $manager->id }}][post_start]"
                                           id="manage[{{ $manager->id }}][post_start]"  type="text" value="{{ $manager->post_start }}">
                                </div>

                                <div class="posts clearfix">
                                    <label class="pull-left" for="manage[{{ $manager->id }}][post_1]">Post #1</label>
                                    <input class="form-control posts_time_input posts_time_input_1"
                                           name="manage[{{ $manager->id }}][post_1]" id="manage[{{ $manager->id }}][post_1]"
                                           type="text" value="{{ $manager->post_1 }}">
                                </div>

                                <div class="posts clearfix">
                                    <label class="pull-left" for="manage[{{ $manager->id }}][post_2]">Post #2</label>
                                    <input class="form-control posts_time_input posts_time_input_1"
                                           name="manage[{{ $manager->id }}][post_2]" id="manage[{{ $manager->id }}][post_2]"
                                           type="text" value="{{ $manager->post_2 }}">
                                </div>

                                <div class="posts clearfix">
                                    <label class="pull-left" for="manage[{{ $manager->id }}][post_3]">Post #3</label>
                                    <input class="form-control posts_time_input posts_time_input_1"
                                           name="manage[{{ $manager->id }}][post_3]" id="manage[{{ $manager->id }}][post_3]"
                                           type="text" value="{{ $manager->post_3 }}">
                                </div>

                                <div class="posts clearfix">
                                    <label class="pull-left" for="manage[{{ $manager->id }}][post_4]">Post #4</label>
                                    <input class="form-control posts_time_input posts_time_input_1"
                                           name="manage[{{ $manager->id }}][post_4]" id="manage[{{ $manager->id }}][post_4]"
                                           type="text" value="{{ $manager->post_4 }}">
                                </div>

                                <div class="posts clearfix">
                                    <label class="pull-left" for="manage[{{ $manager->id }}][post_5]">Post #5</label>
                                    <input class="form-control posts_time_input posts_time_input_1"
                                           name="manage[{{ $manager->id }}][post_5]" id="manage[{{ $manager->id }}][post_5]"
                                           type="text" value="{{ $manager->post_5 }}">
                                </div>

                                <div class="posts clearfix">
                                    <label class="pull-left" for="manage[{{ $manager->id }}][post_6]">Post #6</label>
                                    <input class="form-control posts_time_input posts_time_input_1"
                                           name="manage[{{ $manager->id }}][post_6]" id="manage[{{ $manager->id }}][post_6]"
                                           type="text" value="{{ $manager->post_6 }}">
                                </div>

                                <div class="posts clearfix">
                                    <label class="pull-left" for="manage[{{ $manager->id }}][post_7]">Post #7</label>
                                    <input class="form-control posts_time_input posts_time_input_1"
                                           name="manage[{{ $manager->id }}][post_7]" id="manage[{{ $manager->id }}][post_7]"
                                           type="text" value="{{ $manager->post_7 }}">
                                </div>

                                <div class="posts clearfix">
                                    <label class="pull-left" for="manage[{{ $manager->id }}][post_8]">Post #8</label>
                                    <input class="form-control posts_time_input posts_time_input_1"
                                           name="manage[{{ $manager->id }}][post_8]" id="manage[{{ $manager->id }}][post_8]"
                                           type="text" value="{{ $manager->post_8 }}">
                                </div>

                                <div class="posts clearfix">
                                    <label class="pull-left" for="manage[{{ $manager->id }}][post_9]">Post #9</label>
                                    <input class="form-control posts_time_input posts_time_input_1"
                                           name="manage[{{ $manager->id }}][post_9]" id="manage[{{ $manager->id }}][post_9]"
                                           type="text" value="{{ $manager->post_9 }}">
                                </div>

                                <div class="posts clearfix">
                                    <label class="pull-left" for="manage[{{ $manager->id }}][post_10]">Post #10</label>
                                    <input class="form-control posts_time_input "
                                           name="manage[{{ $manager->id }}][post_10]" id="manage[{{ $manager->id }}][post_10]"
                                           type="text" value="{{ $manager->post_10 }}">
                                </div>

                                <div class="posts clearfix">
                                    <label class="pull-left" for="manage[{{ $manager->id }}][post_11]">Post #11</label>
                                    <input class="form-control posts_time_input"
                                           name="manage[{{ $manager->id }}][post_11]" id="manage[{{ $manager->id }}][post_11]"
                                           type="text" value="{{ $manager->post_11 }}">
                                </div>

                                <div class="posts clearfix">
                                    <label class="pull-left" for="manage[{{ $manager->id }}][post_12]">Post #12</label>
                                    <input class="form-control posts_time_input"
                                           name="manage[{{ $manager->id }}][post_12]" id="manage[{{ $manager->id }}][post_12]"
                                           type="text" value="{{ $manager->post_12 }}">
                                </div>

                                <div class="posts clearfix">
                                    <label class="pull-left" for="manage[{{ $manager->id }}][post_finish]">Finish</label>
                                    <input class="form-control posts_time_input"
                                           name="manage[{{ $manager->id }}][post_finish]" id="manage[{{ $manager->id }}][post_finish]"
                                           type="text" value="{{ $manager->post_finish }}">
                                </div>
                            </div>

                            <div class="panel-footer"></div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 center">
                        <p>Currently there are no stages!</p>
                        <p>
                            Please <a href="{{ route('participants.stages', ['participant' => $participant->id]) }}"
                                      class="btn btn-success">add a Stage</a> for {{ $participant->name }}
                        </p>
                    </div>
                @endforelse

                @if($participant->participantManagers->count())
                    <div class="clear"></div>

                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary ">Submit</button>
                    <a href="{{ route('participants.index') }}" class="btn btn-danger">Cancel</a>
                    <a href="{{ route('participants.stages.index', ['participant' => $participant->id]) }}" class="btn btn-warning">Add stages</a>
                @endif
            </form>
        </div>
    </div>
@endsection