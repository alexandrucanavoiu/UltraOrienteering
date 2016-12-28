
@extends('layouts/template')

@section('title')
    Ranking Categories - Ultra Orienteering Software - Open Source Software
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>
                <h1 class="page-header">Ranking for category {{ $category->name }} - Stage {{ $stage->name }}</h1>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ranking category {{ $category->name }} - Stage {{ $stage->name }}
                    </div>
                    <div class="panel-body">

                        <?php
                        $rankings = array();

                        $x = 1;
                        $unique_id = 0;
                        foreach($participant as $key => $single_participant)
                        {
                            $decrease_rank = 0;

                            $rankings[$unique_id]['rank'] = $x;

                            if(isset($participant[$key-1]))
                            {
                               if($single_participant->total_time == $participant[$key-1]->total_time)
                               {
                                   $decrease_rank = 1;
                                   $rankings[$unique_id]['rank'] = $x-1;
                               }
                            }
                            $rankings[$unique_id]['participant_name'] = $single_participant->participant->name;
                            $rankings[$unique_id]['participant_club_name'] = $single_participant->participant->club->name;
                            $rankings[$unique_id]['total_time'] = $single_participant->total_time;
                            $rankings[$unique_id]['uuidcard'] = $single_participant->uuidcard->uuidcard;
                            if($decrease_rank == 0)
                            {
                                $x++;
                            }

                            $unique_id++;
                        }
                        ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Participant Name</th>
                                    <th>UUID Card</th>
                                    <th>Total Time</th>
                                </tr>
                                @foreach($rankings as $participant)
                                <tr>
                                    <td>@if($participant['total_time'] === 'ERROR !!' || $participant['total_time'] === '00:00:00') - @else {{ $participant['rank'] }} @endif</td>
                                    <td><strong>{{ $participant['participant_name'] }}</strong> ({{ $participant['participant_club_name'] }})</td>
                                    <td>{{ $participant['uuidcard'] }}</td>
                                    <td>@if($participant['total_time'] === 'ERROR !!' || $participant['total_time'] === '00:00:00') Disqualified @else {{ $participant['total_time'] }} @endif </td>
                                </tr>
                                @endforeach
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection