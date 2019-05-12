@extends('layouts/template')
@section('title') Ranking Categories - Ultra Orienteering Software - Open Source Software @endsection
@section('body')
    <section class="content-header">
        <h1>
            Ranking for Category {{ $category->category_name }} (Stage {{ $stage->stage_name }})
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="/rankings">Rankings</a></li>
            <li><a href="/rankings/{{ $category->id }}/view">Stage {{ $stage->stage_name }}</a></li>
            <li><a href="" class="active">Category {{ $category->category_name }}</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <span class="pull-left">
                        <a href="/rankings/{{ $stage->id }}/view" class="btn btn-primary pull-left"><i class="fa  fa-mail-reply"></i> BACK </a>
                    </span>
                    <span class="pull-right">
                        <a target="_blank" href="/rankings/{{ $stage->id }}/view/{{ $category->id }}/ranking/pdf" class="btn btn-success pull-left"><i class="fa fa-file-pdf-o"></i> Export to PDF </a>
                    </span>
                </h1>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="stages table table-bordered">
                            <tbody>
                            <tr>
                                <th class="center" width="5%">Rank #</th>
                                <th width="65%"></th>
                                <th class="center" width="15%">Club Name</th>
                                <th class="center" width="10%">Total Time</th>
                            </tr>
                            @foreach($list_ranks as $participant)
                                <tr>
                                    <td class="center">{{ $participant['rank'] }}</td>
                                    <td>
                                        <table class="stages table table-bordered">
                                            <tbody>
                                            <tr>
                                                <th width="25%">Participant Name</th>
                                                <th class="center" width="5%">UUID Card</th>
                                                <th class="center" width="5%">Missed Post</th>
                                                <th width="40%">Order Posts</th>
                                                <th class="center" width="10%">Time</th>
                                            </tr>
                                            @foreach($participant['participant_name'] as $key => $name)
                                            <tr>
                                                <td>{{ $name }}</td>
                                                <td class="center">{{ $participant['uuidcard_id'][$key] }}</td>
                                                <td class="center">@if($participant['missed_posts'][$key] !== '') Yes @else No @endif</td>
                                                <td>
                                                    @foreach($participant['participant_order_posts'] as $participant_posts)
                                                        <?php
                                                        if(!empty($participant_posts)){
                                                        $someArray = json_decode($participant_posts, true);
                                                        } else {
                                                        $someArray = [];
                                                        }
                                                        ?>
                                                    @endforeach
                                                    @foreach($someArray as $order)
                                                        @if($order['post'] == '251')
                                                            Start ({{ date('h:i:s',$order['time']) }}),
                                                        @elseif($order['post'] == '252')
                                                            Finish ({{ date('h:i:s',$order['time']) }})
                                                        @else
                                                            P{{ $order['post'] }} ({{ date('h:i:s',$order['time']) }}),
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="center">{{ $participant['participant_time'][$key] }}</td>
                                            </tr>
                                 @endforeach
                                            </tbody>
                                        </table>

                                    </td>
                                    <td>{{ $participant['participant_club_name'] }}</td>
                                    <td class="center">{{ $participant['total_time'] }}</td>
                                </tr>
                            @endforeach
                            @foreach($disqualified_abandon as $participant)
                                <tr>
                                    <td class="center">-</td>
                                    <td>
                                        <table class="stages table table-bordered">
                                            <tbody>
                                            <tr>
                                                <th width="25%">Participant Name</th>
                                                <th class="center" width="5%">UUID Card</th>
                                                <th class="center" width="5%">Missed Post</th>
                                                <th width="40%">Order Posts</th>
                                                <th class="center" width="10%">Time</th>
                                            </tr>
                                            @foreach($participant['participant_name'] as $key => $name)
                                                <tr>
                                                    <td>{{ $name }}</td>
                                                    <td class="center">{{ $participant['uuidcard_id'][$key] }}</td>
                                                    @if($participant['total_time'] === "Abandon")
                                                        <td class="center">-</td>
                                                        @else
                                                        <td class="center">@if($participant['missed_posts'][$key] !== '') Yes @else No @endif</td>
                                                    @endif
                                                    <td>
                                                        @if(!empty($participant['participant_order_posts'][$key]))
                                                        <?php $someArray = json_decode($participant['participant_order_posts'][$key], true) ?>
                                                        @foreach($someArray as $order)
                                                            @if($order['post'] == '251')
                                                                Start ({{ date('h:i:s',$order['time']) }}),
                                                            @elseif($order['post'] == '252')
                                                                Finish ({{ date('h:i:s',$order['time']) }})
                                                            @else
                                                                P{{ $order['post'] }} ({{ date('h:i:s',$order['time']) }}),
                                                            @endif
                                                        @endforeach
                                                            @else
                                                            -
                                                        @endif
                                                    </td>
                                                    @if($participant['participant_abandon'][$key] === 'Abandon')
                                                        <td class="center">-</td>
                                                        @else
                                                        <td class="center">{{ $participant['participant_time'][$key] }}</td>
                                                     @endif
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </td>
                                    <td>{{ $participant['participant_club_name'] }}</td>
                                    <td class="center">{{ $participant['total_time'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection