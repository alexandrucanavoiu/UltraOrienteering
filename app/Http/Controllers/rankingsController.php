<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Club;
use App\Models\Participant;
use App\Models\UuidCard;
use App\Models\Stage;
use App\Models\ParticipantManager;
use Illuminate\Http\Request;
use DB;
use Illuminate\Validation\Rule;

class rankingsController extends Controller
{
    public function index()
    {
        $stages = Stage::All();

        $number = 1;

        return view('rankings.index', compact('stages', 'number'));
     }

    public function category($id)
    {

        $stage = Stage::findOrFail($id);
        $category = Category::All();

        return view('rankings.category', compact('category', 'stage'));
    }

    public function rankinglist($id_stage, $id_category)
    {

        $stage = Stage::findOrFail($id_stage);
        $category = Category::findOrFail($id_category);

        $participant = ParticipantManager::where('category_id', '=', $id_category)->where('stage_id', '=', $id_stage)->orderBy('total_time', 'asc')->get();

        $number = 1;

        return view('rankings.rankinglist', compact('participant', 'stage', 'category', 'number'));
    }


    public function totalranking()
    {

        $number = 1;
        $stages = Stage::All();
        $participant = Participant::All();
        $participantManager = ParticipantManager::All();
        $stagescount = Stage::count();
        foreach($participant as $singleRow)
        {
            $nrOfApps=ParticipantManager::where('participant_id',$singleRow->id)->count();
            if($nrOfApps==$stagescount)
            {
                $total_hours=0;
                $total_mins=0;
                $total_secs=0;
                $rows=ParticipantManager::where('participant_id',$singleRow->id)->get();
                foreach($rows as $row)
                {
                    $time = explode(":",$row->total_time);
                    if($time[0]=="23" && $time[1]=="59" && $time[2]=="59")
                    {
                        $time[0]="00";
                        $time[1]="00";
                        $time[2]="00";
                    }
                    $hours=$time[0];
                    $mins=$time[1];
                    $seconds=$time[2];
                    $total_secs+=$seconds;
                    $total_mins+=$mins;
                    $total_hours+=$hours;

                    while($total_secs>60)
                    {
                        $total_mins++;
                        $total_secs=$total_secs-60;
                    }
                    while($total_mins>60)
                    {
                        $total_hours++;
                        $total_mins=$total_mins-60;
                    }
                }
                $total_time="";
                if($total_hours>9)
                {
                    $total_time=$total_hours;
                }
                else{
                    $total_time="0".$total_hours;
                }
                $total_time.=":";
                if($total_mins>9)
                {
                    $total_time.=$total_mins;
                }
                else
                {
                    $total_time.="0".$total_mins;
                }
                $total_time.=":";
                if($total_secs>9)
                {
                    $total_time.=$total_secs;
                }
                else{
                    $total_time.="0".$total_secs;
                }

                $concurents[]=array(
                  "time"=>  $total_time,
                   "name"=>$singleRow->name,
                );
                $times[]=$total_time;


            }


        }

        array_multisort($times, SORT_ASC, $concurents);//sortare dupa timp

        return view('rankings.total', compact('number', 'stages','concurents'));
    }

}

