<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-baqh{text-align:center;vertical-align:top}
    .tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
    .tg .tg-yw4l{vertical-align:top}
    .tg .center{text-align: center}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 100%">
    <tr>
        <th class="tg-baqh" colspan="5">List of Participants for Stage {{ $stage->name }} for Category {{ $category->name }}</th>
    </tr>
    <tr>
        <td style="width: 5%" class="tg-amwm">No</td>
        <td style="width: 35%" class="tg-amwm">Club Name<br></td>
        <td style="width: 30%" class="tg-amwm">Participant Name<br></td>
        <td style="width: 10%" class="tg-amwm">UUID</td>
        <td style="width: 10%" class="tg-amwm">Category</td>
    </tr>
    @foreach($participants as $participant)
    <tr>
        <td class="tg-yw4l center">{{ $number++ }}</td>
        <td class="tg-yw4l">{{ $participant->participant->club->name }}</td>
        <td class="tg-yw4l">{{ $participant->participant->name }}</td>
        <td class="tg-yw4l center">{{ $participant->participant->uuidcard->uuidcard }}</td>
        <td class="tg-yw4l center">{{ $participant->category->name }}</td>
    </tr>
        @endforeach
</table>