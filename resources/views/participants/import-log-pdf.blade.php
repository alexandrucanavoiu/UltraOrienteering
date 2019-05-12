<html>
<head>
    <title></title>
    <style type="text/css">
        #page-wrap {
            width: 100%;
            margin: 0 auto;
        }
        .center-justified {
            text-align: justify;
            margin: 0 auto;
            width: 30em;
        }
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
        .grey {
            background: #DDDDDD;
        }

    </style>
</head>
<body>
<div id="page-wrap">
    <h1 class="center-justified">Jurnal for Stage {{ $stage_name }}</h1>
    <br /><br />
    <table width="100%" style="font-size: 12px;" border="1">
        <tbody>
        <tr>
            <th class="center" style="width: 2%">Nr #</th>
            <th class="center" style="width: 35%">Participant</th>
            <th class="center" style="width: 10%">UUID Card</th>
            <th class="center" style="width: 10%">Category</th>
            <th class="center" style="width: 10%">Missed Post</th>
            <th class="center" style="width: 15%">Order Posts</th>
        </tr>
        @foreach($response_data as $data)
            <tr class="import-list @if($data['posts_missed'] == NULL) none @else grey @endif">
                <td class="center">{{ $data['uuid_id'] }}</td>
                <td>{{ $data['participant_name'] }} ({{ $data['team_name'] }})</td>
                <td class="center">Nr #{{ $data['uuid_id'] }} ({{ $data['uuid_name'] }})</td>
                <td class="center">{{ $data['category'] }}</td>
                <td class="center">@if($data['posts_missed'] == NULL) NO @else Yes @endif</td>
                <td class="center">
                    @if(!empty($data['posts_participant']))
                        @foreach($data['posts_participant'] as $key => $participant_posts)
                            <div>Post: {{ $key }} - Time: {{ $participant_posts }}</div>
                        @endforeach
                    @else
                        <div class="center">OK</div>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
