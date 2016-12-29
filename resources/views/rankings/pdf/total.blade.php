<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:12px;padding:1px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-baqh{text-align:center;vertical-align:top}
    .tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
    .tg .tg-yw4l{vertical-align:top}
    body { font-size: 14px; font-family:Arial}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 100%">
    <tr>
        <th class="tg-baqh" colspan="3"><h3>General Rangkins of All Stages </h3></th>
    </tr>
    <tr>
        <td style="width: 10%" class="tg-amwm">No</td>
        <td style="width: 75%" class="tg-amwm">Participant Name<br></td>
        <td style="width: 15%" class="tg-amwm">Total Time<br></td>
    </tr>
    @foreach($concurents as $row)
        @if($row['time'] !== "00:00:00")
    <tr>
        <td class="tg-baqh">{{ $number++ }}</td>
        <td class="tg-yw4l"><strong>{{$row['name']}}</strong> ({{$row['club']}})</td>
        <td class="tg-baqh">{{$row['time']}}</td>
    </tr>
        @endif
    @endforeach
</table>