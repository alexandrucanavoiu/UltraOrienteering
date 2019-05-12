<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Club;
use App\Models\Participant;
use App\Models\ParticipantStages;
use App\Models\RelayCategory;
use App\Models\RelayParticipantStage;
use App\Models\Setting;
use App\Models\UuidCard;
use App\Models\Stage;
use App\Models\ParticipantManager;
use Illuminate\Http\Request;
use DB;
use Illuminate\Validation\Rule;
use Excel;
use PDF;
use App\TimesCounter;
use App\SortAscTotalTime;

class rankingsController extends Controller
{
    public function index()
    {
        $stages = Stage::All();

        $number = 1;

        return view('rankings.index', compact('stages', 'number'));
     }

    public function categories($id)
    {
        $setting = Setting::findOrFail(1);
        $competition_type = $setting->competition_type;

        if($competition_type === 1){
            $number = 1;
            $stage = Stage::findOrFail($id);
            $categories = Category::with('route')->get();
            return view('rankings.category', compact('categories', 'stage','number'));
        } else {
            $number = 1;
            $stage = Stage::findOrFail($id);
            $categories = RelayCategory::with('CategoryManager')->get();
            return view('rankings.relay_category', compact('categories', 'stage','number'));
        }
    }

    public function ranking_category($id_stage, $id_category)
    {

        $setting = Setting::findOrFail(1);
        $competition_type = $setting->competition_type;

        if($competition_type === 1){
            $stage = Stage::findOrFail($id_stage);
            $category = Category::findOrFail($id_category);

            $participant = ParticipantStages::with('uuidcard')->with('participant')->where('categories_id', '=', $id_category)->where('stages_id', '=', $id_stage)->orderBy('total_time', 'asc')->get();

            $number = 1;

            $rankings = array();
            $disqualified = array();
            $abandon = array();

            $x = 1;
            $unique_id = 0;
            foreach($participant as $key => $single_participant)
            {
                if($single_participant->abandon == 1)
                {
                    $disqualified[$key]['participant_name'] = $single_participant->participant->participant_name;
                    $disqualified[$key]['participant_club_name'] = $single_participant->participant->club->club_name;
                    $disqualified[$key]['uuidcard'] = '#' . $single_participant->uuidcard->id . ' (' .$single_participant->uuidcard->uuid_name . ')';
                    $disqualified[$key]['missed_posts'] = $single_participant->missed_posts;
                    $disqualified[$key]['participant_order_posts'] = $single_participant->order_posts;
                    $disqualified[$key]['total_time'] = 'Abandon';


                } elseif($single_participant->missed_posts !== ''){
                    $abandon[$key]['participant_name'] = $single_participant->participant->participant_name;
                    $abandon[$key]['participant_club_name'] = $single_participant->participant->club->club_name;
                    $abandon[$key]['uuidcard'] = '#' . $single_participant->uuidcard->id . ' (' .$single_participant->uuidcard->uuid_name . ')';
                    $abandon[$key]['missed_posts'] = $single_participant->missed_posts;
                    $abandon[$key]['participant_order_posts'] = $single_participant->order_posts;
                    $abandon[$key]['total_time'] = 'Disqualified';
                } else {

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
                    $rankings[$unique_id]['participant_name'] = $single_participant->participant->participant_name;
                    $rankings[$unique_id]['participant_club_name'] = $single_participant->participant->club->club_name;
                    $rankings[$unique_id]['uuidcard'] = '#' . $single_participant->uuidcard->id . ' (' .$single_participant->uuidcard->uuid_name . ')';
                    $rankings[$unique_id]['missed_posts'] = $single_participant->missed_posts;
                    $rankings[$unique_id]['participant_order_posts'] = $single_participant->order_posts;
                    $rankings[$unique_id]['total_time'] = $single_participant->total_time;
                    if($decrease_rank == 0)
                    {
                        $x++;
                    }

                    $unique_id++;

                }
            }
            $disqualified_abandon = array_merge($abandon, $disqualified);

            return view('rankings.rankinglist', compact('participant', 'stage', 'category', 'number', 'rankings', 'disqualified_abandon'));
        } else {

            $stage = Stage::findOrFail($id_stage);
            $category = RelayCategory::findOrFail($id_category);


            $participant = RelayParticipantStage::with('participant', 'participants', 'uuidcard', 'participant_stage', 'category', 'CategoryManager', 'route')->where('relay_categories_id', '=', $id_category)->where('stages_id', '=', $id_stage)->orderBy('total_time', 'asc')->get();


            $number = 1;

            $participants = array();
            $rankings = array();
            $disqualified = array();
            $abandon = array();
            $rank_players = array();
            $list_ranks = array();

            $x = 1;
            $unique_id = 0;

            $disqualified = array();
            $abandon = array();
            $ranks = array();
            $x = 1;
            $unique_id = 0;

            foreach($participant as $key => $single_participant) {
                {
                    $participants[$single_participant->relay_participant_id][] = $single_participant;

                }
            }

            // add in a multidimensional array the participants grouped with details
            foreach ($participants as $key => $players){

                foreach ($players as $player){

                    $rankings[$key]['participant_name'][] = $player->participant_stage->participant_name;
                    $rankings[$key]['uuidcard_id'][] = $player->participant_stage->uuidcard->id;
                    $rankings[$key]['participant_club_name'] = $player->participant->club->club_name;
                    $rankings[$key]['missed_posts'][] = $player->missed_posts;
                    $rankings[$key]['participant_order_posts'][] = $player->order_posts;
                    $rankings[$key]['relay_participant_id'] = $player->relay_participant_id;

                    if($player->abandon == 1){
                        $rankings[$key]['participant_abandon'][] = 'Abandon';
                    } else {
                        $rankings[$key]['participant_abandon'][] = '';
                    }
                    if ($player->missed_posts !== ''){
                        $rankings[$key]['participant_disqualified'][] = 'Disqualified';
                    } else {
                        $rankings[$key]['participant_disqualified'][] = '';
                    }

                    $rankings[$key]['participant_time'][] = $player->total_time;
                }
                    $counter = new TimesCounter($rankings[$key]['participant_time']);
                    $rankings[$key]['total_time'] = $counter->get_total_time();
                    $rankings[$key]['total_time_unix'] = strtotime($rankings[$key]['total_time']);
            }

            // reset the keys from 31,54,43 to 0,1,2,...
            $rankings = array_values($rankings);

            // separation Abandon / Disqualified participants from  participants list
            foreach ($rankings as $key => $rank){
                if(in_array('Abandon', $rank['participant_abandon'])){
                    $abandon[$key] = $rank;
                    $abandon[$key]['total_time'] = 'Abandon';
                } elseif(in_array("Disqualified", $rank['participant_disqualified'])){
                    $disqualified[$key] = $rank;
                    $disqualified[$key]['total_time'] = 'Disqualified';
                } else {
                    $rank_players[] = $rank;
                }
            }

            // sort by total_time_unix
            usort($rank_players, function($a, $b) {
                return $a['total_time_unix'] <=> $b['total_time_unix'];
            });


            foreach ($rank_players as $key => $rank_player){

                $decrease_rank = 0;
                $list_ranks[$unique_id] = $rank_player;
                $list_ranks[$unique_id]['rank'] = $x;

                if(isset($rank_players[$key-1]))
                {
                    if($rank_player['total_time'] == $rank_players[$key-1]['total_time'])
                    {
                        $decrease_rank = 1;
                        $list_ranks[$unique_id]['rank'] = $x-1;
                    }
                }

                if($decrease_rank == 0)
                {
                    $x++;
                }

                $unique_id++;
            }

            $disqualified_abandon = array_merge($disqualified, $abandon);

            return view('rankings.relay_rankinglist', compact('participant', 'stage', 'category', 'number', 'list_ranks', 'disqualified_abandon'));
        }

    }

    public function ranking_category_pdf($id_stage, $id_category)
    {

        $setting = Setting::findOrFail(1);
        $competition_type = $setting->competition_type;

        if($competition_type === 1){
            $stage = Stage::findOrFail($id_stage);
            $category = Category::findOrFail($id_category);

            $participant = ParticipantStages::with('uuidcard')->with('participant')->where('categories_id', '=', $id_category)->where('stages_id', '=', $id_stage)->orderBy('total_time', 'asc')->get();

            $number = 1;

            $rankings = array();
            $disqualified = array();
            $abandon = array();

            $x = 1;
            $unique_id = 0;
            foreach($participant as $key => $single_participant)
            {
                if($single_participant->abandon == 1)
                {
                    $disqualified[$key]['participant_name'] = $single_participant->participant->participant_name;
                    $disqualified[$key]['participant_club_name'] = $single_participant->participant->club->club_name;
                    $disqualified[$key]['uuidcard'] = '#' . $single_participant->uuidcard->id;
                    $disqualified[$key]['missed_posts'] = $single_participant->missed_posts;
                    $disqualified[$key]['participant_order_posts'] = $single_participant->order_posts;
                    $disqualified[$key]['total_time'] = 'Abandon';


                } elseif($single_participant->missed_posts !== ''){
                    $abandon[$key]['participant_name'] = $single_participant->participant->participant_name;
                    $abandon[$key]['participant_club_name'] = $single_participant->participant->club->club_name;
                    $abandon[$key]['uuidcard'] = '#' . $single_participant->uuidcard->id;
                    $abandon[$key]['missed_posts'] = $single_participant->missed_posts;
                    $abandon[$key]['participant_order_posts'] = $single_participant->order_posts;
                    $abandon[$key]['total_time'] = 'Disqualified';
                } else {

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
                    $rankings[$unique_id]['participant_name'] = $single_participant->participant->participant_name;
                    $rankings[$unique_id]['participant_club_name'] = $single_participant->participant->club->club_name;
                    $rankings[$unique_id]['uuidcard'] = '#' . $single_participant->uuidcard->id;
                    $rankings[$unique_id]['missed_posts'] = $single_participant->missed_posts;
                    $rankings[$unique_id]['participant_order_posts'] = $single_participant->order_posts;
                    $rankings[$unique_id]['total_time'] = $single_participant->total_time;
                    if($decrease_rank == 0)
                    {
                        $x++;
                    }

                    $unique_id++;

                }
            }
            $disqualified_abandon = array_merge($abandon, $disqualified);

            $pdf=PDF::loadView('rankings.pdf.category', ['participant' => $participant, 'stage' => $stage, 'category' => $category, 'number' => $number, 'rankings' => $rankings, 'disqualified_abandon' => $disqualified_abandon])->setPaper('a4', 'landscape');
            return $pdf->stream('ranking_stage'. $id_stage .'_category'.$id_category.'.pdf');
        } else {

            $stage = Stage::findOrFail($id_stage);
            $category = RelayCategory::findOrFail($id_category);


            $participant = RelayParticipantStage::with('participant', 'participants', 'uuidcard', 'participant_stage', 'category', 'CategoryManager', 'route')->where('relay_categories_id', '=', $id_category)->where('stages_id', '=', $id_stage)->orderBy('total_time', 'asc')->get();


            $number = 1;

            $participants = array();
            $rankings = array();
            $disqualified = array();
            $abandon = array();

            $x = 1;
            $unique_id = 0;

            $disqualified = array();
            $abandon = array();
            $ranks = array();
            $x = 1;
            $unique_id = 0;

            foreach($participant as $key => $single_participant) {
                {
                    $participants[$single_participant->relay_participant_id][] = $single_participant;

                }
            }

            // add in a multidimensional array the participants grouped with details

            foreach ($participants as $key => $players){

                foreach ($players as $player){

                    $rankings[$key]['participant_name'][] = $player->participant_stage->participant_name;
                    $rankings[$key]['uuidcard_id'][] = $player->participant_stage->uuidcard->id;
                    $rankings[$key]['participant_club_name'] = $player->participant->club->club_name;
                    $rankings[$key]['missed_posts'][] = $player->missed_posts;
                    $rankings[$key]['participant_order_posts'][] = $player->order_posts;
                    $rankings[$key]['relay_participant_id'] = $player->relay_participant_id;

                    if($player->abandon == 1){
                        $rankings[$key]['participant_abandon'][] = 'Abandon';
                    } else {
                        $rankings[$key]['participant_abandon'][] = '';
                    }
                    if ($player->missed_posts !== ''){
                        $rankings[$key]['participant_disqualified'][] = 'Disqualified';
                    } else {
                        $rankings[$key]['participant_disqualified'][] = '';
                    }

                    $rankings[$key]['participant_time'][] = $player->total_time;
                }
                $counter = new TimesCounter($rankings[$key]['participant_time']);
                $rankings[$key]['total_time'] = $counter->get_total_time();
                $rankings[$key]['total_time_unix'] = strtotime($rankings[$key]['total_time']);
            }


            // reset the keys from 31,54,43 to 0,1,2,...
            $rankings = array_values($rankings);

            // separation Abandon / Disqualified participants from  participants list
            foreach ($rankings as $key => $rank){
                if(in_array('Abandon', $rank['participant_abandon'])){
                    $abandon[$key] = $rank;
                    $abandon[$key]['total_time'] = 'Abandon';
                } elseif(in_array("Disqualified", $rank['participant_disqualified'])){
                    $disqualified[$key] = $rank;
                    $disqualified[$key]['total_time'] = 'Disqualified';
                } else {
                    $rank_players[] = $rank;
                }
            }

            // sort by total_time_unix
            usort($rank_players, function($a, $b) {
                return $a['total_time_unix'] <=> $b['total_time_unix'];
            });


            foreach ($rank_players as $key => $rank_player){

                $decrease_rank = 0;
                $list_ranks[$unique_id] = $rank_player;
                $list_ranks[$unique_id]['rank'] = $x;

                if(isset($rank_players[$key-1]))
                {
                    if($rank_player['total_time'] == $rank_players[$key-1]['total_time'])
                    {
                        $decrease_rank = 1;
                        $list_ranks[$unique_id]['rank'] = $x-1;
                    }
                }

                if($decrease_rank == 0)
                {
                    $x++;
                }

                $unique_id++;
            }

            $disqualified_abandon = array_merge($disqualified, $abandon);



            $pdf=PDF::loadView('rankings.pdf.relay_category', ['participant' => $participant, 'stage' => $stage, 'category' => $category, 'number' => $number, 'list_ranks' => $list_ranks, 'disqualified_abandon' => $disqualified_abandon])->setPaper('a4', 'landscape');
            return $pdf->stream('ranking_stage'. $id_stage .'_category'.$id_category.'.pdf');

        }
    }


    public function totalranking()
{

    $times = array();
    $concurents = array();
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
                "club"=>$singleRow->club->name,
            );
            $times[]=$total_time;


        }


    }

    if(is_array($times)) {
        array_multisort($times, SORT_ASC, $concurents);//sortare dupa timp

    } else {
        $times[] = "00:00:00";
        $concurents[] = "";
    }

    return view('rankings.total', compact('number', 'stages','concurents'));
    }

    public function totalrankingexportpdf()
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
                    "club"=>$singleRow->club->name,
                );
                $times[]=$total_time;


            }


        }
            array_multisort($times, SORT_ASC, $concurents);


        $pdf=PDF::loadView('rankings.pdf.total', ['stages'=>$stages,'concurents'=>$concurents, 'number'=>$number ]);
        return $pdf->stream('rankingtotal.pdf');

    }

}

