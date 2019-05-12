<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Participant;
use App\Models\ParticipantManager;
use App\Models\ParticipantStages;
use App\Models\RelayCategory;
use App\Models\RelayParticipant;
use App\Models\RelayParticipantManager;
use App\Models\RelayParticipantStage;
use App\Models\Setting;
use App\Models\Stage;
use App\Models\UuidCard;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Route;

class dashboardController extends Controller
{

    public function dashboard() {

        $setting = Setting::findOrFail(1);
        $competition_type = $setting->competition_type;

        if($competition_type === 1){

            $count_clubs = Club::All()->count();
            $count_paticipants = Participant::All()->count();
            $count_stages = Stage::All()->count();
            $count_categories = Category::All()->count();
            $count_routes = Route::All()->count();
            $count_uuidcard = UuidCard::All()->count();
            $routelist = Route::paginate(15);


            $uuid_used_in_relay_participants_stages = ParticipantStages::All('uuidcards_id');

            $uuid_participants = [];
            foreach ($uuid_used_in_relay_participants_stages as $participant_details){
                $uuid_participants[] .= $participant_details->uuidcards_id;
            }
            $participants_without_stage = Participant::with('uuidcard')->whereNotIn('uuidcards_id', $uuid_participants)->paginate(6);

            $competition_type = "STANDARD";

            $best_time = ParticipantStages::OrderBy('total_time', 'ASC')->whereNotIn('total_time', ['00:00:00'])->get()->first();
            $longest_time = ParticipantStages::OrderBy('total_time', 'DESC')->get()->first();

            if($best_time === null){
                $best_time = "00:00:00";
            } else {
                $best_time = $best_time->total_time;
            }

            if($longest_time === null){
                $longest_time = "00:00:00";
            } else {
                $longest_time = $longest_time->total_time;
            }

            $categories_list = Category::get();

            $number_categories = 1;

            return view('dashboard', ['count_uuidcard' => $count_uuidcard, 'count_clubs' => $count_clubs, 'count_categories' => $count_categories, 'count_stages' => $count_stages, 'routelist' => $routelist, 'count_routes' => $count_routes, 'count_participants' => $count_paticipants, 'competition_type' => $competition_type, 'participants_without_stage' => $participants_without_stage, 'best_time' => $best_time, 'longest_time' => $longest_time, 'categories_list' => $categories_list, 'number_categories' => $number_categories]);
        } else {
            $count_clubs = Club::All()->count();
            $count_teams = RelayParticipant::All()->count();
            $count_paticipants = RelayParticipantManager::All()->count();
            $count_stages = Stage::All()->count();
            $count_categories = RelayCategory::All()->count();
            $count_routes = Route::All()->count();
            $count_uuidcard = UuidCard::All()->count();
            $routelist = Route::paginate(15);


            $uuid_used_in_relay_participants_stages = RelayParticipantStage::All('uuidcards_id');

            $uuid_participants = [];
            foreach ($uuid_used_in_relay_participants_stages as $participant_details){
                $uuid_participants[] .= $participant_details->uuidcards_id;
            }
            $participants_without_stage = RelayParticipantManager::with('uuidcard')->whereNotIn('uuidcards_id', $uuid_participants)->paginate(6);

            $competition_type = "RELAY";

            $best_time = RelayParticipantStage::OrderBy('total_time', 'ASC')->whereNotIn('total_time', ['00:00:00'])->get()->first();
            $longest_time = RelayParticipantStage::OrderBy('total_time', 'DESC')->get()->first();

            if($best_time === null){
                $best_time = "00:00:00";
            } else {
                $best_time = $best_time->total_time;
            }

            if($longest_time === null){
                $longest_time = "00:00:00";
            } else {
                $longest_time = $longest_time->total_time;
            }


            $categories_list = RelayCategory::with('CategoryManager')->get();

            $number_categories = 1;

            return view('relay-dashboard', ['count_uuidcard' => $count_uuidcard, 'count_clubs' => $count_clubs, 'count_teams' => $count_teams, 'count_categories' => $count_categories, 'count_stages' => $count_stages, 'routelist' => $routelist, 'count_routes' => $count_routes, 'count_participants' => $count_paticipants, 'competition_type' => $competition_type, 'participants_without_stage' => $participants_without_stage, 'best_time' => $best_time, 'longest_time' => $longest_time, 'categories_list' => $categories_list, 'number_categories' => $number_categories]);
        }
    }

}
