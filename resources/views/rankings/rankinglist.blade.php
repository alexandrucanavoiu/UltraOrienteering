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
            <li><a href="/rankings/{{ $stage->id }}/view">Stage {{ $stage->stage_name }}</a></li>
            <li><a href="#">Category {{ $category->category_name }}</a></li>
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
                        <?php

                        ?>
                        <table class="stages table table-bordered">
                            <tbody>
                            <tr>
                                <th class="center" width="5%">Rank #</th>
                                <th width="30%">Participant Name</th>
                                <th class="center" width="10%">UUID Card</th>
                                <th class="center" width="5%">Missed Post</th>
                                <th class="center" width="40%">Order Posts</th>
                                <th class="center" width="10%">Total Time</th>
                            </tr>
                            @foreach($rankings as $participant)
                                <tr>
                                    <td class="center">{{ $participant['rank'] }}</td>
                                    <td><strong>{{ $participant['participant_name'] }}</strong> ({{ $participant['participant_club_name'] }})</td>
                                    <td class="center">{{ $participant['uuidcard'] }}</td>
                                    <td class="center">@if($participant['missed_posts'] !== '') Yes @else No @endif</td>
                                    <td>
                                    <?php
                                            if(!empty($participant['participant_order_posts'])){
                                                $someArray = json_decode($participant['participant_order_posts'], true);
                                            } else {
                                                $someArray = [];
                                            }
                                    ?>
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
                                    <td class="center">{{ $participant['total_time'] }}</td>
                                </tr>
                            @endforeach
                            @foreach($disqualified_abandon as $missed)
                                <tr>
                                    <td class="center">-</td>
                                    <td><strong>{{ $missed['participant_name'] }}</strong> ({{ $missed['participant_club_name'] }})</td>
                                    <td class="center">{{ $missed['uuidcard'] }}</td>
                                    <td class="center">
                                        @if($missed['total_time'] !== 'Abandon' )
                                        @if($missed['missed_posts'] !== '') Yes @else No @endif
                                            @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <?php $someArray = json_decode($missed['participant_order_posts'], true) ?>
                                        @if(!empty($someArray))
                                                @foreach($someArray as $order)
                                                    @if($order['post'] == '251')
                                                        Start ({{ date('h:i:s',$order['time']) }})
                                                    @elseif($order['post'] == '252')
                                                        Finish ({{ date('h:i:s',$order['time']) }})
                                                    @else
                                                        P{{ $order['post'] }} ({{ date('h:i:s',$order['time']) }})
                                                    @endif
                                                @endforeach
                                            @else
                                            -
                                         @endif
                                    </td>
                                    <td class="center">{{ $missed['total_time'] }}</td>
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