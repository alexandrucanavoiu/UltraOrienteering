<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Participant;
use App\Models\ParticipantManager;
use App\Models\ParticipantStages;
use App\Models\RelayCategory;
use App\Models\RelayCategoryManager;
use App\Models\RelayParticipant;
use App\Models\RelayParticipantManager;
use App\Models\RelayParticipantStage;
use App\Models\Route;
use App\Models\Setting;
use App\Models\Stage;
use App\Models\UuidCard;
use DateTime;
use Validator;
use Illuminate\Http\Request;

class ParticipantStagesController extends Controller
{
    public function index($id)
    {

        $setting = Setting::findOrFail(1);
        $competition_type = $setting->competition_type;

        if($competition_type === 1){
            $participant = Participant::with('club', 'uuidcard')->where('id', $id)->first();
            $participant_stages = ParticipantStages::with('stage', 'category')->where('participants_id', $id)->paginate(15);
            $categories = Category::all();
            $stages = Stage::all();

            return view('participants.stages.index', compact('participant', 'participant_stages', 'stages', 'categories'));
        } else {
            $participant_list_stages = RelayParticipantStage::with('uuidcard', 'participant')->where('relay_participant_id', $id)->get();
            $participant_id = $id;
            $participant_list_stages_count = $participant_list_stages->count();

            $arrayParticipantsStages = [];

            foreach ($participant_list_stages as $key => $list){
                $arrayParticipantsStages[$list->stages_id][] =  $list;
            }

            $count_arrayParticipantsStages = count($arrayParticipantsStages);
            $list_participants = RelayParticipantManager::where('relay_participant_id', $id)->get();
            $count_participants = $list_participants->count();

            $arrayParticipantsStagesDetails = [];
            foreach ($arrayParticipantsStages as $key => $ParticipantsStages){
                foreach ($ParticipantsStages as $x){
                    $participant = RelayParticipantManager::where('id', $x->relay_participant_managers_id)->get()->first();
                    $stage = Stage::where('id', $x->stages_id)->get()->first();
                    $category = RelayCategory::where('id', $x->relay_categories_id)->get()->first();
                    $route = Route::where('id', $x->routes_id)->get()->first();
                    $uuidcard = UuidCard::where('id', $x->uuidcards_id)->get()->first();

                    $arrayParticipantsStagesDetails[$key]['participants'][$participant->participant_name]['participant_name'] = $participant->participant_name;
                    $arrayParticipantsStagesDetails[$key]['participants'][$participant->participant_name]['total_time'] = $x->total_time;
                    if(!empty($x->abandon)){
                        $arrayParticipantsStagesDetails[$key]['participants'][$participant->participant_name]['abandon'] = "Yes";
                    } else {
                        $arrayParticipantsStagesDetails[$key]['participants'][$participant->participant_name]['abandon'] = "No";
                    }
                    if(!empty($x->missed_posts)){
                        $arrayParticipantsStagesDetails[$key]['participants'][$participant->participant_name]['missed_posts'] = "Yes";
                    } else {
                        $arrayParticipantsStagesDetails[$key]['participants'][$participant->participant_name]['missed_posts'] = "No";
                    }
                    $arrayParticipantsStagesDetails[$key]['participants'][$participant->participant_name]['stage'] =  $stage->stage_name;
                    $arrayParticipantsStagesDetails[$key]['participants'][$participant->participant_name]['category'] =  $category->category_name;
                    $arrayParticipantsStagesDetails[$key]['participants'][$participant->participant_name]['route'] =  $route->route_name;
                    $arrayParticipantsStagesDetails[$key]['participants'][$participant->participant_name]['uuidcard_id'] =  $uuidcard->id;
                    $arrayParticipantsStagesDetails[$key]['participants'][$participant->participant_name]['uuidcard_name'] =  $uuidcard->uuid_name;
                    $arrayParticipantsStagesDetails[$key]['participants'][$participant->participant_name]['participant_stage_id'] =  $x->id;
                    $arrayParticipantsStagesDetails[$key]['stage_name'] =  $stage->stage_name;
                    $arrayParticipantsStagesDetails[$key]['stages_id'] =  $stage->id;
                    $arrayParticipantsStagesDetails[$key]['participant_id'] =  $id;
                }
            }

            return view('participants.stages.relay_index', compact('list_participants', 'arrayParticipantsStagesDetails', 'count_arrayParticipantsStages', 'count_participants', 'participant_id', 'participant_list_stages_count'));
        }
    }

    public function create($id, Request $request)
    {
        if( $request->ajax() )
        {
            $setting = Setting::findOrFail(1);
            $competition_type = $setting->competition_type;
            $participant_id = $id;

            if($competition_type === 1){
                $participant = Participant::where('id', $id)->first();
                $participant_stages_list = ParticipantStages::where('participants_id', $id)->get('stages_id');
                $stages = Stage::whereNotIn('id', $participant_stages_list)->get();

                if($stages->count() > 0){
                    $categories = Category::get();
                } else {
                    $categories = [];
                }

                return view('participants.stages.create', ['stages' => $stages, 'categories' => $categories, 'participant' => $participant]);
            } else {

                $participant = RelayParticipant::where('id', $id)->first();
                $participant_stages = RelayParticipantStage::where('relay_participant_id', $id)->get('stages_id');
                $stages = Stage::whereNotIn('id', $participant_stages)->get();
                $relay_partipant = RelayParticipant::where('id', $id)->get()->first();
                $relay_partipant_manager = RelayParticipantManager::where('relay_participant_id', $id)->get();
                $relay_categories = RelayCategory::with('CategoryManager')->get();

                return view('participants.stages.relay_create', ['participant_id' => $participant_id, 'participant' => $participant, 'stages' => $stages, 'relay_partipant' => $relay_partipant, 'relay_partipant_manager' => $relay_partipant_manager, 'relay_categories' => $relay_categories]);
            }
        }  else {
            return redirect('/participants')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function category_route_select($participantID, $CategoryID, Request $request){

        if( $request->ajax() )
        {
            $routes = RelayCategoryManager::with('route')->where('relay_category_id', $CategoryID)->get();

            if(!empty($routes)){
                $arrayRoutes = [];
                foreach ($routes as $key => $route){
                    $arrayRoutes[$key]['relay_route_id'] = $route->route->id;
                    $arrayRoutes[$key]['relay_route_name'] = $route->route->route_name;
                }
                return response()->json(['routes' => $arrayRoutes]);
            }
        }
    }

    public function store($id, Request $request, RelayParticipantStage $relayParticipantStage)
    {
        if( $request->ajax() )
        {
            $setting = Setting::findOrFail(1);
            $competition_type = $setting->competition_type;

            if($competition_type === 1){
                $participant = Participant::findOrFail($id);

                $request->merge(['participants_id' => $id]);
                $request->merge(['uuidcards_id' => $participant->uuidcards_id]);
                $request->merge(['start_time' => "00:00:00"]);
                $request->merge(['finish_time' => "00:00:00"]);
                $request->merge(['total_time' => "00:00:00"]);
                $request->merge(['abandon' => 1]);
                $request->merge(['created_at' => date('Y-m-d H:i:s')]);
                $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                $rules = [
                    'stages_id' => 'required|numeric|exists:stages,id',
                    'categories_id' => 'required|numeric|exists:categories,id',
                ];

                $data = $request->only(['uuidcards_id', 'participants_id', 'stages_id', 'categories_id', 'start_time', 'finish_time', 'total_time', 'abandon', 'created_at', 'updated_at']);
                $validator = Validator::make($data, $rules);

                if($validator->passes())

                {
                    $save = ParticipantStages::create($data);
                    $check_count = ParticipantStages::where('participants_id', $id)->get()->count();
                    $stage = Stage::where('id', $save->stages_id)->first();
                    $category = Category::where('id', $save->categories_id)->first();

                    $missed_posts = "";
                    if(!empty($save->missed_posts)){
                        $missed_posts = "YES";
                    } else {
                        $missed_posts = "NO";
                    }

                    if($save->abandon == 1){
                        $abandon = "YES";
                    } else {
                        $abandon = "NO";
                    }

                    return response()->json(['id' => $save->id, 'participants_id' => $save->participants_id, 'stages_id' => $save->stages_id,'stage_name' => $stage->stage_name, 'category_name' => $category->category_name, 'total_time' => $save->total_time, 'missed_posts' => $missed_posts, 'abandon' => $abandon, 'check_count' => $check_count, 'success' => 'The participant has been enrolled.']);

                } else {
                    return response()->json(['error' => $validator->errors()->all()]);
                }
            } else {
                $participant = RelayParticipant::findOrFail($id);

                $request->merge(['start_time' => "00:00:00"]);
                $request->merge(['finish_time' => "00:00:00"]);
                $request->merge(['total_time' => "00:00:00"]);
                $request->merge(['abandon' => 1]);
                $request->merge(['created_at' => date('Y-m-d H:i:s')]);
                $request->merge(['updated_at' => date('Y-m-d H:i:s')]);

                $rules = [
                    'stages_id' => 'required|numeric|exists:stages,id',
                    'relay_category_id' => 'required|numeric|exists:relay_categories,id',
                    'relay_participant_id' => 'required|array|min:1|max:255',
                    'relay_participant_id.*' => 'required',
                    'routes_id' => 'required|array|min:1|max:255',
                    'routes_id.*' => 'required',
                    'relay_participant_managers_id' => 'required|array|min:1|max:255',
                    'relay_participant_managers_id.*' => 'required',
                    'uuidcards_id' => 'required|array|min:1|max:255',
                    'uuidcards_id.*' => 'required',
                ];


                $participants_id = $request->get('relay_participant_id');
                $participant_name_array = explode(',', $participants_id);
                $request->merge(['relay_participant_id' => $participant_name_array]);

                $routes_id = $request->get('routes_id');
                $routes_id_array = explode(',', $routes_id);
                $request->merge(['routes_id' => $routes_id_array]);

                $relay_participant_managers_id = $request->get('relay_participant_managers_id');
                $relay_participant_managers_id_array = explode(',', $relay_participant_managers_id);
                $request->merge(['relay_participant_managers_id' => $relay_participant_managers_id_array]);

                $uuidcards_id = $request->get('uuidcards_id');
                $uuidcards_id_array = explode(',', $uuidcards_id);
                $request->merge(['uuidcards_id' => $uuidcards_id_array]);

                $data = $request->only(['stages_id', 'relay_category_id', 'relay_participant_id', 'relay_participant_managers_id', 'uuidcards_id', 'routes_id', 'start_time', 'finish_time', 'total_time', 'abandon', 'created_at', 'updated_at']);
                $validator = Validator::make($data, $rules);

                function arrayContainsDuplicate($array)
                {
                    return count($array) != count(array_unique($array));
                }

                $check_routes_if_are_unique = arrayContainsDuplicate($routes_id_array);

                if($validator->passes())

                {

                    if($check_routes_if_are_unique == true){
                        $validator->errors()->add('routes_id.*', 'Route need to be unique for each participant!');
                        return response()->json(['error' => $validator->errors()->all()]);
                    }

                    $ParticipantsStagesArray = [];
                    $ParticipantsDetails = [];
                    $missed_posts = "";


                foreach ($relay_participant_managers_id_array as $key => $participant){

                    $relay_categories_managers = RelayCategoryManager::where('relay_category_id', $data['relay_category_id'])->where('routes_id', $routes_id_array[$key])->get()->first();
                    $relay_categories_managers_id = $relay_categories_managers->id;

                    $ParticipantsStagesArray[] = [
                        'relay_participant_id' => $participant_name_array[$key],
                        'relay_participant_managers_id'=> $participant,
                        'uuidcards_id'=> $uuidcards_id_array[$key],
                        'stages_id'=> $data['stages_id'],
                        'relay_categories_id'=> $data['relay_category_id'],
                        'relay_category_managers_id'=> $relay_categories_managers_id,
                        'routes_id'=> $routes_id_array[$key],
                        'start_time'=> $data['start_time'],
                        'finish_time'=> $data['finish_time'],
                        'total_time'=> $data['total_time'],
                        'abandon'=> $data['abandon'],
                        'created_at'=> date('Y-m-d H:i:s'),
                        'updated_at'=> date('Y-m-d H:i:s'),
                    ];

                }

                    $relayParticipantStage->createArray($ParticipantsStagesArray);

                    $participant_list_stages = RelayParticipantStage::where('relay_participant_id', $participants_id)->get();
                    $check_count = $participant_list_stages->count();

                    return response()->json(['check_count' => $check_count, 'relay_participant_id' => $id, 'success' => 'The participants have been enrolled.']);

                } else {
                    return response()->json(['error' => $validator->errors()->all()]);
                }

            }


        }  else {
            return redirect('/participants')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function edit($participantID, $stagesID, Request $request)
    {
        if( $request->ajax() )
        {
            $setting = Setting::findOrFail(1);
            $competition_type = $setting->competition_type;

            if($competition_type === 1){
                $participants_stage = ParticipantStages::with('participant', 'stage')->where('participants_id', $participantID)->where('stages_id', $stagesID)->first();
                $stages_used = ParticipantStages::where('participants_id', $participantID)->get('stages_id');
                $stagesID_conver_to_numberic = (int)$stagesID;
                $stages_used_list = [];
                foreach ($stages_used as $stage){
                    if($stage->stages_id !== $stagesID_conver_to_numberic){
                        $stages_used_list[] = $stage->stages_id;
                    }
                }
                $stages = Stage::whereNotIn('id', $stages_used_list)->get();
                $categories = Category::get();
                return view('participants.stages.edit', ['participants_stage' => $participants_stage, 'stages' => $stages, 'categories' => $categories]);
            } else {

                $participant = RelayParticipant::where('id', $participantID)->first();
                $participant_category_selected = RelayParticipantStage::where('relay_participant_id', $participantID)->where('stages_id', $stagesID)->get('relay_categories_id')->first();
                $participant_category_selected = $participant_category_selected->relay_categories_id;
                $routes_based_on_category_selected = RelayCategoryManager::with('category', 'route')->where('relay_category_id', $participant_category_selected)->get();

                $stages_used = RelayParticipantStage::where('relay_participant_id', $participantID)->get('stages_id');

                $stagesID_conver_to_numberic = (int)$stagesID;
                $stages_used_list = [];
                foreach ($stages_used as $stage){
                    if($stage->stages_id !== $stagesID_conver_to_numberic){
                        $stages_used_list[] = $stage->stages_id;
                    }
                }

                $stages = Stage::whereNotIn('id', $stages_used_list)->get();
                $relay_partipant = RelayParticipant::where('id', $participantID)->get()->first();
                $relay_categories = RelayCategory::with('CategoryManager')->get();


                $relay_partipant_manager = RelayParticipantStage::with('participants', 'participant_stage', 'CategoryManager', 'category')->where('relay_participant_id', $participantID)->where('stages_id', $stagesID)->get();


                return view('participants.stages.relay_edit', ['participant' => $participant, 'stages' => $stages, 'participantID' => $participantID, 'stagesID' => $stagesID, 'participant_category_selected' => $participant_category_selected, 'routes_based_on_category_selected' => $routes_based_on_category_selected, 'relay_partipant' => $relay_partipant, 'relay_partipant_manager' => $relay_partipant_manager, 'relay_categories' => $relay_categories]);

            }

        }  else {
            return redirect('/participants')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function update($participantID, $stagesID, Request $request, RelayParticipantStage $relayParticipantStage)
    {
        if( $request->ajax() )
        {
            $setting = Setting::findOrFail(1);
            $competition_type = $setting->competition_type;

            if($competition_type === 1){
                $participants_stage = ParticipantStages::where('participants_id', $participantID)->where('stages_id', $stagesID)->get()->first();
                $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                $request->merge(['participants_id' => $participantID]);

                if($request->get('start_time') == "00:00:00" && $request->get('finish_time') == "00:00:00"){
                    $rules = [
                        'stages_id' => 'required|numeric|exists:stages,id',
                        'categories_id' => 'required|numeric|exists:categories,id',
                        'abandon' => 'required|numeric|digits_between::0,1',
                        'missed_posts' => 'min:1,max:255',
                    ];
                } else {
                    $rules = [
                        'stages_id' => 'required|numeric|exists:stages,id',
                        'categories_id' => 'required|numeric|exists:categories,id',
                        'start_time' => 'required|date_format:H:i:s|before:finish_time|regex:/^[0-9,:]+$/',
                        'finish_time' => 'required|date_format:H:i:s|after:start_time|regex:/^[0-9,:]+$/',
                        'abandon' => 'required|numeric|digits_between::0,1',
                        'missed_posts' => 'min:1,max:255',
                    ];
                }


                //TODO: validate start_time / finish if is not 00:00:00, regex not working

                $strStart = $request->get('start_time');
                $strEnd   = $request->get('finish_time');
                $dteStart = new DateTime($strStart);
                $dteEnd   = new DateTime($strEnd);
                $dteDiff  = $dteStart->diff($dteEnd);
                $total_time = $dteDiff->format("%H:%I:%S");
                $request->merge(['total_time' => $total_time]);

                $data = $request->only(['participants_id', 'stages_id', 'categories_id', 'start_time', 'finish_time', 'total_time', 'abandon', 'missed_posts', 'updated_at']);

                $validator = Validator::make($data, $rules);

                if ($validator->passes()) {
                    $participants_stage->update($data);
                    $stages = Stage::where('id', $participants_stage->stages_id)->first();
                    $categories = Category::where('id', $participants_stage->categories_id)->first();


                    $missed_posts = "";
                    if(!empty($participants_stage->missed_posts)){
                        $missed_posts = "YES";
                    } else {
                        $missed_posts = "NO";
                    }

                    if($participants_stage->abandon == 1){
                        $abandon = "YES";
                    } else {
                        $abandon = "NO";
                    }

                    return response()->json(['success' => 'Great! The Stage for this participant has been updated.', 'id' => $participants_stage->id, 'stage_name' => $stages->stage_name, 'category_name' => $categories->category_name, 'participants_stage' => $participants_stage, 'total_time' => $total_time, 'abandon' => $abandon, 'missed_posts' => $missed_posts]);

                } else {
                    return response()->json(['error' => $validator->errors()->all()]);
                }
            } else {
                $participant = RelayParticipant::findOrFail($participantID);

                $request->merge(['start_time' => "00:00:00"]);
                $request->merge(['finish_time' => "00:00:00"]);
                $request->merge(['total_time' => "00:00:00"]);
                $request->merge(['abandon' => 1]);
                $request->merge(['created_at' => date('Y-m-d H:i:s')]);
                $request->merge(['updated_at' => date('Y-m-d H:i:s')]);

                $rules = [
                    'stages_id' => 'required|numeric|exists:stages,id',
                    'relay_category_id' => 'required|numeric|exists:relay_categories,id',
                    'relay_participant_id' => 'required|array|min:1|max:255',
                    'relay_participant_id.*' => 'required',
                    'routes_id' => 'required|array|min:1|max:255',
                    'routes_id.*' => 'required',
                    'relay_participant_managers_id' => 'required|array|min:1|max:255',
                    'relay_participant_managers_id.*' => 'required',
                    'uuidcards_id' => 'required|array|min:1|max:255',
                    'uuidcards_id.*' => 'required',
                ];


                $participants_id = $request->get('relay_participant_id');
                $participant_name_array = explode(',', $participants_id);
                $request->merge(['relay_participant_id' => $participant_name_array]);

                $routes_id = $request->get('routes_id');
                $routes_id_array = explode(',', $routes_id);
                $request->merge(['routes_id' => $routes_id_array]);

                $relay_participant_managers_id = $request->get('relay_participant_managers_id');
                $relay_participant_managers_id_array = explode(',', $relay_participant_managers_id);
                $request->merge(['relay_participant_managers_id' => $relay_participant_managers_id_array]);

                $uuidcards_id = $request->get('uuidcards_id');
                $uuidcards_id_array = explode(',', $uuidcards_id);
                $request->merge(['uuidcards_id' => $uuidcards_id_array]);

                $data = $request->only(['stages_id', 'relay_category_id', 'relay_participant_id', 'relay_participant_managers_id', 'uuidcards_id', 'routes_id', 'start_time', 'finish_time', 'total_time', 'abandon', 'created_at', 'updated_at']);
                $validator = Validator::make($data, $rules);

                function arrayContainsDuplicate($array)
                {
                    return count($array) != count(array_unique($array));
                }

                $check_routes_if_are_unique = arrayContainsDuplicate($routes_id_array);


                if($validator->passes())

                {

                    if($check_routes_if_are_unique == true){
                        $validator->errors()->add('routes_id.*', 'Route need to be unique for each participant!');
                        return response()->json(['error' => $validator->errors()->all()]);
                    }

                    RelayParticipantStage::where('relay_participant_id', $participantID)->where('stages_id', $stagesID)->delete();

                    $ParticipantsStagesArray = [];
                    $ParticipantsDetails = [];
                    $missed_posts = "";


                    foreach ($relay_participant_managers_id_array as $key => $participant){

                        $relay_categories_managers = RelayCategoryManager::where('relay_category_id', $data['relay_category_id'])->where('routes_id', $routes_id_array[$key])->get()->first();
                        $relay_categories_managers_id = $relay_categories_managers->id;

                        $ParticipantsStagesArray[] = [
                            'relay_participant_id' => $participant_name_array[$key],
                            'relay_participant_managers_id'=> $participant,
                            'uuidcards_id'=> $uuidcards_id_array[$key],
                            'stages_id'=> $data['stages_id'],
                            'relay_categories_id'=> $data['relay_category_id'],
                            'relay_category_managers_id'=> $relay_categories_managers_id,
                            'routes_id'=> $routes_id_array[$key],
                            'start_time'=> $data['start_time'],
                            'finish_time'=> $data['finish_time'],
                            'total_time'=> $data['total_time'],
                            'abandon'=> $data['abandon'],
                            'created_at'=> date('Y-m-d H:i:s'),
                            'updated_at'=> date('Y-m-d H:i:s'),
                        ];

                    }

                    $relayParticipantStage->createArray($ParticipantsStagesArray);

                    $participant_list_stages = RelayParticipantStage::where('relay_participant_id', $participants_id)->get();
                    $check_count = $participant_list_stages->count();

                    return response()->json(['check_count' => $check_count, 'relay_participant_id' => $participantID, 'success' => 'The stage has been updated.']);


                } else {
                    return response()->json(['error' => $validator->errors()->all()]);
                }
            }

        }  else {
            return redirect('/participants')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function relay_stages_management($id, Request $request){

        if( $request->ajax() )
        {
            $participants_stage = RelayParticipantStage::with('participant_stage', 'category', 'CategoryManager', 'stage', 'route', 'uuidcard')->findOrFail($id);

            return view('participants.stages.relay_management_edit', ['participants_stage' => $participants_stage]);

        }  else {
            return redirect('/participants')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }

    }

    public function relay_stages_management_update($id, Request $request){

        if( $request->ajax() )
        {

            $participants_stage = RelayParticipantStage::findOrFail($id);
            $request->merge(['updated_at' => date('Y-m-d H:i:s')]);

            if($request->get('start_time') == "00:00:00" && $request->get('finish_time') == "00:00:00"){
                $rules = [
                    'abandon' => 'required|numeric|digits_between::0,1',
                    'missed_posts' => 'min:1,max:255',
                ];
            } else {
                $rules = [
                    'start_time' => 'required|date_format:H:i:s|before:finish_time|regex:/^[0-9,:]+$/',
                    'finish_time' => 'required|date_format:H:i:s|after:start_time|regex:/^[0-9,:]+$/',
                    'abandon' => 'required|numeric|digits_between::0,1',
                    'missed_posts' => 'min:1,max:255',
                ];
            }


            //TODO: validate start_time / finish if is not 00:00:00, regex not working

            $strStart = $request->get('start_time');
            $strEnd   = $request->get('finish_time');
            $dteStart = new DateTime($strStart);
            $dteEnd   = new DateTime($strEnd);
            $dteDiff  = $dteStart->diff($dteEnd);
            $total_time = $dteDiff->format("%H:%I:%S");
            $request->merge(['total_time' => $total_time]);

            $data = $request->only(['start_time', 'finish_time', 'total_time', 'abandon', 'missed_posts', 'updated_at']);

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $participants_stage->update($data);

                $missed_posts = "";
                if(!empty($participants_stage->missed_posts)){
                    $missed_posts = "Yes";
                } else {
                    $missed_posts = "No";
                }

                if($participants_stage->abandon == 1){
                    $abandon = "Yes";
                } else {
                    $abandon = "No";
                }

                return response()->json(['success' => 'Great! The Stage for this participant has been updated.', 'id' => $id, 'total_time' => $total_time, 'abandon' => $abandon, 'missed_posts' => $missed_posts]);

            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }


        }  else {
            return redirect('/participants')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }

    }

    public function delete($participantID, $stagesID, Request $request)
    {
        if ( $request->ajax() ) {

            $setting = Setting::findOrFail(1);
            $competition_type = $setting->competition_type;

            if($competition_type === 1){
                $particpants_stage_id = ParticipantStages::where('participants_id', $participantID)->where('stages_id', $stagesID)->first();
                $particpants_stage = ParticipantStages::where('participants_id', $participantID)->where('stages_id', $stagesID)->delete();
                $check_count = ParticipantStages::where('participants_id', $participantID)->get()->count();
                return response()->json(['check_count' => $check_count, 'id' => $particpants_stage_id->id,'success' => 'Great! The Stage has been removed for this participant!']);
            } else {
                $particpants_stage = RelayParticipantStage::where('relay_participant_id', $participantID)->where('stages_id', $stagesID)->delete();
                $check_count = RelayParticipantStage::where('relay_participant_id', $participantID)->get();

                $check = [];
                foreach ($check_count as $count){
                    $check[$count->stages_id][] = "";
                }
                $check_count = count($check);
                $stages_id = $stagesID;
                return response()->json(['check_count' => $check_count, 'stages_id' => $stages_id, 'success' => 'Great! The Stage has been removed for those participants!']);
            }
        } else {
            return redirect('/participants')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

}
