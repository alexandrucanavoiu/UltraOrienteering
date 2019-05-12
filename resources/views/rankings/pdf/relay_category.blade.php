<title>Ranking for the {{ $category->category_name }} category in {{ $stage->stage_name }} stage</title>
<style type="text/css">
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse; }

    tr.border-bottom td, td.border-bottom {
        border-bottom: 1px solid;
    }
    tr.border-top td, td.border-top {
        border-top: 1px solid;
    }
    tr.border-right td, td.border-right {
        border-right: 1px solid;
    }
    tr.border-right td:last-child {
        border-right: 0px;
    }
    tr.center td, td.center, th.center {
        text-align: center;
        display: table-cell;
        text-align: center;
        vertical-align: middle;
    }

    tr.right-center td, td.right-center {
        text-align: right;
        padding-right: 50px;
    }
    tr.right td, td.right {
        text-align: right;
    }
    body{
        font-size: 12px;
    }

</style>
<h2>Ranking for the {{ $category->category_name }} category in {{ $stage->stage_name }} stage</h2>

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