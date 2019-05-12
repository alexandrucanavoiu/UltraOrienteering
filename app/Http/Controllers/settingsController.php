<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Club;
use App\Models\Participant;
use App\Models\ParticipantStages;
use App\Models\RelayCategory;
use App\Models\RelayCategoryManager;
use App\Models\RelayParticipant;
use App\Models\RelayParticipantManager;
use App\Models\RelayParticipantStage;
use App\Models\Route;
use App\Models\RouteManager;
use App\Models\Setting;
use App\Models\Stage;
use DB;
use Illuminate\Http\Request;
use Validator;


class settingsController extends Controller
{

    public function index(){

        $settings = Setting::where('id', 1)->get()->first();
        return view('settings.index', ['settings' => $settings]);

    }

    public function edit(Request $request)
    {
        if( $request->ajax() )
        {
            $settings = Setting::findOrFail(1);

            return view('settings.edit', ['settings' => $settings]);
        }  else {
            return redirect('/settings')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function update(Request $request)
    {
        if( $request->ajax() )
        {
            $id = 1;
            $settings = Setting::findOrFail($id);
            $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
            $rules = [
                'organizer_name' => 'required|max:255|min:3',
                'competition_type' => 'required|numeric|digits_between::1,2',
            ];

            $old_game_type = $settings->game_type;

            $data = $request->only(['organizer_name','competition_type','updated_at']);


            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $settings->update($data);
                $organizer_name = $settings->organizer_name;
                $competition_type = $settings->competition_type;

                // check if the data is the same
                if($old_game_type === $data['competition_type']){
                    return response()->json(['success' => 'Great! The Settings have been updated.', 'id' => $settings->id, 'organizer_name' => $organizer_name, 'competition_type' => $competition_type]);
                }


                if($competition_type == 1){
                    $competition_type = "Standard Competition";
                } else {
                    $competition_type = "Relay Competition";
                }

                if($settings->competition_type !== $old_game_type){

                    if($settings->competition_type == 1){
                        DB::statement("SET foreign_key_checks=0");
                        Category::truncate();
                        Club::truncate();
                        Participant::truncate();
                        ParticipantStages::truncate();
                        RelayCategory::truncate();
                        RelayCategoryManager::truncate();
                        RelayParticipant::truncate();
                        RelayParticipantManager::truncate();
                        RelayParticipantStage::truncate();
                        Route::truncate();
                        RouteManager::truncate();
                        Stage::truncate();
                        DB::statement("SET foreign_key_checks=1");
                    }

                    if($settings->competition_type == 2){
                        DB::statement("SET foreign_key_checks=0");
                        Category::truncate();
                        Club::truncate();
                        Participant::truncate();
                        ParticipantStages::truncate();
                        RelayCategory::truncate();
                        RelayCategoryManager::truncate();
                        RelayParticipant::truncate();
                        RelayParticipantManager::truncate();
                        RelayParticipantStage::truncate();
                        Route::truncate();
                        RouteManager::truncate();
                        Stage::truncate();
                        DB::statement("SET foreign_key_checks=1");
                    }


                }


                return response()->json(['success' => 'Great! The Settings have been updated.', 'id' => $settings->id, 'organizer_name' => $organizer_name, 'competition_type' => $competition_type]);

            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }
        }  else {
            return redirect('/settings')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

}
