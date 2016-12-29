<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:12px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-baqh{text-align:center;vertical-align:top}
    .tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
    .tg .tg-yw4l{vertical-align:top}
    body { font-size: 14px; font-family:Arial}
</style>
<title>Ranking for the {{ $category->name }} category in {{ $stage->name }} stage</title>
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

<table class="tg" style="undefined;table-layout: fixed; width: 100%">
    <tr>
        <th class="tg-baqh" colspan="4"><h3> Ranking for the {{ $category->name }} category in {{ $stage->name }} stage </h3></th>
    </tr>
    <tr>
        <td style="width: 10%" class="tg-amwm">No</td>
        <td class="tg-amwm">Participant Name<br></td>
        <td style="width: 15%" class="tg-amwm">UUID Card<br></td>
        <td style="width: 15%" class="tg-amwm">Total Time<br></td>
    </tr>

    @foreach($rankings as $participant)
        <tr>
            <td class="tg-baqh">@if($participant['total_time'] === 'ERROR !!' || $participant['total_time'] === '00:00:00' || $participant['total_time'] === '23:59:59') - @else {{ $participant['rank'] }} @endif</td>
            <td class="tg-yw4l"><strong>{{ $participant['participant_name'] }}</strong> ({{ $participant['participant_club_name'] }})</td>
            <td class="tg-baqh">{{ $participant['uuidcard'] }}</td>
            <td class="tg-baqh">@if($participant['total_time'] === 'ERROR !!' || $participant['total_time'] === '00:00:00' || $participant['total_time'] === '23:59:59') Disqualified @else {{ $participant['total_time'] }} @endif </td>
        </tr>
    @endforeach


</table>