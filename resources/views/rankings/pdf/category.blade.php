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

</style>
<h2>Ranking for the {{ $category->category_name }} category in {{ $stage->stage_name }} stage</h2>

<table class="stages table table-bordered">
    <tbody>
    <tr>
        <th class="center" width="5%">Rank #</th>
        <th width="35%">Participant Name</th>
        <th class="center" width="5%">UUID Card</th>
        <th class="center" width="5%">Missed Post</th>
        <th class="center" width="40%">Order Posts</th>
        <th class="center" width="10%">Total Time</th>
    </tr>
    @foreach($rankings as $participant)
        <tr>
            <td class="center">{{ $participant['rank'] }}</td>
            <td><strong>{{ $participant['participant_name'] }}</strong> ({{ $participant['participant_club_name'] }})</td>
            <td class="center">{{ $participant['uuidcard'] }}</td>
            <td class="center">@if($participant['missed_posts'] == 1) Yes @else No @endif</td>
            <td>
                <?php $someArray = json_decode($participant['participant_order_posts'], true) ?>
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