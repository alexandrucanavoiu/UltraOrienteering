<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Participant;
use App\Models\ParticipantStages;
use App\Models\RelayParticipant;
use App\Models\RelayParticipantManager;
use App\Models\RelayParticipantStage;
use App\Models\Route;
use App\Models\RouteManager;
use App\Models\Setting;
use App\Models\Stage;
use App\Models\UuidCard;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use PDF;
use Ramsey\Uuid\Uuid;
use stdClass;
use Yajra\Datatables\Datatables;
use Validator;
use Input;

class ParticipantsController extends Controller
{
    /**
     * Serve page to see all the Participants in the system
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $setting = Setting::findOrFail(1);
        $competition_type = $setting->competition_type;

        if($competition_type === 1){
            $participants = Participant::with('uuidcard', 'club')->orderBy('participant_name', 'ASC')->get();
            return view('participants.index', compact('participants'));
        } else {
            $participants = RelayParticipant::with('club')->orderBy('clubs_id', 'ASC')->get();

            $arrayParticipants = [];

            foreach ($participants as $key => $participant){
                $RelayParticipantManager = RelayParticipantManager::with('uuidcard')->where('relay_participant_id', $participant->id)->get();
                $count_stages_enrolled = RelayParticipantStage::where('relay_participant_id', $participant->id)->get()->count();
                $count_RelayParticipantManager = count($RelayParticipantManager);
                $key_number = 0;


                foreach ($RelayParticipantManager as $manager){
                    $key_number++;
                    if($count_RelayParticipantManager == $key_number){
                        $arrayParticipants[$key]['participants'][] = $manager->participant_name . ' (#' . $manager->uuidCard->id . ' - ' . $manager->uuidCard->uuid_name . ")";
                    } else {
                        $arrayParticipants[$key]['participants'][] = $manager->participant_name . ' (#' . $manager->uuidCard->id . ' - ' . $manager->uuidCard->uuid_name . "), ";
                    }
                    $arrayParticipants[$key]['stages'][] = $count_stages_enrolled;
                }
                $arrayParticipants[$key]['participants'] = implode($arrayParticipants[$key]['participants']);
                $arrayParticipants[$key]['club'] = $participant->club->club_name;
            }
            return view('participants.relay_index', compact('arrayParticipants', 'participants'));
        }
    }

    public function index_anyData_all()
    {

        $setting = Setting::findOrFail(1);
        $competition_type = $setting->competition_type;

        if($competition_type === 1){
            $participants = Participant::with('uuidcard', 'club')
                ->orderBy('participant_name', 'ASC')->get();
            return Datatables::of($participants)
                ->setRowClass(function ($participants) {
                    return 'participants-list-' . $participants->id;
                })
                ->make(true);
        } else {
            $participants = RelayParticipant::with('club')->orderBy('clubs_id', 'ASC')->get();

            $arrayParticipants = [];

            foreach ($participants as $key => $participant){
                $RelayParticipantManager = RelayParticipantManager::with('uuidcard')->where('relay_participant_id', $participant->id)->get();
                $count_stages_enrolled = RelayParticipantStage::where('relay_participant_id', $participant->id)->get()->count();
                $count_RelayParticipantManager = count($RelayParticipantManager);
                $key_number = 0;


                foreach ($RelayParticipantManager as $manager){
                    $key_number++;
                    if($count_RelayParticipantManager == $key_number){
                        $arrayParticipants[$key]['participants'][] = $manager->participant_name . ' (#' . $manager->uuidCard->id . ' - ' . $manager->uuidCard->uuid_name . ")";
                    } else {
                        $arrayParticipants[$key]['participants'][] = $manager->participant_name . ' (#' . $manager->uuidCard->id . ' - ' . $manager->uuidCard->uuid_name . "), ";
                    }
                    $arrayParticipants[$key]['stages'] = $count_stages_enrolled;
                }
                $arrayParticipants[$key]['participants'] = implode($arrayParticipants[$key]['participants']);
                $arrayParticipants[$key]['club'] = $participant->club->club_name;
                $arrayParticipants[$key]['id'] = $participant->id;
            }

//            $arrayParticipants = json_encode($arrayParticipants);


            return Datatables::of($arrayParticipants)
                ->setRowClass(function ($arrayParticipants) {
                    return 'participants-list-' . $arrayParticipants['id'];
                })
                ->make(true);
        }
    }

    public function edit(Request $request, $id)
    {
        if( $request->ajax() )
        {

            $setting = Setting::findOrFail(1);
            $competition_type = $setting->competition_type;

            if($competition_type === 1){
                $participant = Participant::with('club')->findOrFail($id);
                //TODO: clubs need to be only non-used
                $clubs = Club::get();

                $uuid_used_in_participants = Participant::All('uuidcards_id')->whereNotIn('uuidcards_id', $participant->uuidcards_id);

                if($uuid_used_in_participants->count() > 0){
                    $uuidcards = UuidCard::whereNotIn('id', $uuid_used_in_participants)->get();
                } else {
                    $uuidcards = UuidCard::get();
                }
                return view('participants.edit', compact('participant', 'clubs', 'uuidcards'));
            } else {
                $participant = RelayParticipant::with('club')->findOrFail($id);
                $participant_manager = RelayParticipantManager::with('participant')->where('relay_participant_id', $id)->get();

                $uuid_participants = [];
                foreach ($participant_manager as $participant_details){
                    $uuid_participants[] .= $participant_details->uuidcards_id;
                }

                $uuid_used_in_participants = RelayParticipantManager::All('uuidcards_id')->whereNotIn('uuidcards_id', $uuid_participants);
                $uuidCards = UuidCard::whereNotIn('id', $uuid_used_in_participants)->get();
                $clubs = Club::get();
                return view('participants.relay_edit', compact('participant', 'clubs', 'uuidCards', 'participant_manager'));
            }
        }  else {
            return redirect('/participants')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function update(Request $request, $id, RelayParticipantManager $relayParticipantManager)
    {
        if( $request->ajax() )
        {

            $setting = Setting::findOrFail(1);
            $competition_type = $setting->competition_type;

            if($competition_type === 1){
                $participants = Participant::findOrFail($id);
                $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                $rules = [
                    'participant_name' => 'required|max:255|min:2',
                    'clubs_id' => 'required',
                    'uuidcards_id' => 'required',
                ];
                $data = $request->only(['participant_name', 'clubs_id', 'uuidcards_id', 'updated_at']);

                $validator = Validator::make($data, $rules);

                if ($validator->passes()) {
                    $participants->update($data);
                    $club_name = $participants->club->club_name;
                    $uuid_card = $participants->uuidcard->uuid_name;
                    $uuid_id = $participants->uuidcard->id;
                    $participant_name = $participants->participant_name;
                    return response()->json(['success' => 'Great! The Participant has been updated.', 'id' => $participants->id, 'club_name' => $club_name, 'uuid_card' => $uuid_card, 'uuid_id' => $uuid_id, 'participant_name' => $participant_name]);

                } else {
                    return response()->json(['error' => $validator->errors()->all()]);
                }
            } else {

                $participant = RelayParticipant::findOrFail($id);
                $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                $rules = [
                    'clubs_id' => 'required|numeric|exists:clubs,id',
                    'uuidcards_id' => 'required|array|min:1|max:255',
                    'uuidcards_id.*' => 'required|numeric|exists:uuidcards,id',
                    'participant_name' => 'required|array|min:1|max:255',
                    'participant_name.*' => 'required',
                ];

                $participant_name = $request->get('participant_name');
                $participant_name_array = explode(',', $participant_name);
                $request->merge(['participant_name' => $participant_name_array]);

                $uuidcards_id = $request->get('uuidcards_id');
                $uuidcards_id_array = explode(',', $uuidcards_id);
                $request->merge(['uuidcards_id' => $uuidcards_id_array]);

                function arrayContainsDuplicate($array)
                {
                    return count($array) != count(array_unique($array));
                }

                $check_uuids_if_are_unique = arrayContainsDuplicate($uuidcards_id_array);


                $data = $request->only(['participant_name', 'uuidcards_id', 'clubs_id', 'updated_at']);
                $validator = Validator::make($data, $rules);

                if($check_uuids_if_are_unique == true){
                    $validator->errors()->add('uuidcards_id.*', 'UUID Card need to be unique for each participant!');
                    return response()->json(['error' => $validator->errors()->all()]);
                }

                if($validator->passes())

                {
                    $club = Club::where('id', $data['clubs_id'])->get()->first();
                    $club_name = $club->club_name;

                    // Array from ajax
                    $ParticipantsArray = [];
                    $ParticipantsArrayName = [];

                    foreach ($data['participant_name'] as $key => $participant_array)
                    {
                        $uuid = UuidCard::where('id', $data['uuidcards_id'][$key])->get()->first();

                        $ParticipantsArray[] = [
                            'relay_participant_id' => $participant->id,
                            'participant_name'=> $participant_array,
                            'uuidcards_id'=> $uuid->id,
                            'created_at'=> date('Y-m-d H:i:s'),
                            'updated_at'=> date('Y-m-d H:i:s'),
                        ];


                        $ParticipantsArrayName[] = $participant_array . ' (#' . $data['uuidcards_id'][$key] . ' - ' . $uuid->uuid_name . ')';
                    }

                    $ParticipantsArrayName = implode(", ", $ParticipantsArrayName);

                    DB::table('relay_participants')
                        ->where('id', $id)
                        ->update(['clubs_id' => $data['clubs_id'], 'updated_at' => $data['updated_at']]);
                    RelayParticipantManager::where('relay_participant_id', $id)->delete();
                    RelayParticipantStage::where('relay_participant_id', $id)->delete();
                    $relayParticipantManager->createArray($ParticipantsArray);

                    $check_count = RelayParticipant::get()->count();
                    return response()->json(['id' => $id, 'participant_name' => $ParticipantsArrayName, 'club_name' => $club_name, 'check_count' => $check_count, 'success' => 'The new participants have been added.']);

                } else {
                    return response()->json(['error' => $validator->errors()->all()]);
                }


            }
        }  else {
            return redirect('/clubs')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function create(Request $request)
    {

        if( $request->ajax() )
        {
            $setting = Setting::findOrFail(1);
            $competition_type = $setting->competition_type;

            if($competition_type === 1){
                $uuid_used_in_participants = Participant::All('uuidcards_id');

                if($uuid_used_in_participants->count() > 0){
                    $uuidCards = UuidCard::whereNotIn('id', $uuid_used_in_participants)->get();
                } else {
                    $uuidCards = UuidCard::get();
                }

                $clubs = Club::get();

                return view('participants.create', compact('uuidCards', 'clubs'));
            } else {

                $uuid_used_in_participants = RelayParticipantManager::All('uuidcards_id');

                if($uuid_used_in_participants->count() > 0){
                    $uuidCards = UuidCard::whereNotIn('id', $uuid_used_in_participants)->get();
                } else {
                    $uuidCards = UuidCard::get();
                }

                $clubs = Club::get();

                return view('participants.relay_create', compact('uuidCards', 'clubs'));
            }
        } else {
            return redirect('/participants')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function store(Request $request, RelayParticipantManager $relayParticipantManager)
    {

        if( $request->ajax() )
        {

            $setting = Setting::findOrFail(1);
            $competition_type = $setting->competition_type;

            if($competition_type === 1){
                $request->merge(['created_at' => date('Y-m-d H:i:s')]);
                $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                $rules = [
                    'participant_name' => 'required|max:255|min:3',
                    'clubs_id' => 'required|numeric|exists:clubs,id',
                    'uuidcards_id' => 'required|numeric|exists:uuidcards,id|unique:participants,uuidcards_id',
                ];

                $data = $request->only(['participant_name', 'clubs_id', 'uuidcards_id', 'created_at', 'updated_at']);
                $validator = Validator::make($data, $rules);

                if($validator->passes())

                {
                    $club_name = Club::where('id', $data['clubs_id'])->first();
                    $uuidcard = UuidCard::where('id', $data['uuidcards_id'])->first();
                    $save = Participant::create($data);
                    $check_count = Participant::get()->count();
                    return response()->json(['id' => $save->id, 'participant_name' => $save->participant_name, 'club_name' => $club_name->club_name, 'uuidcard_name' => $uuidcard->uuid_name, 'uuidcard_id' => $uuidcard->id, 'check_count' => $check_count, 'success' => 'The new participant has been added.']);

                } else {
                    return response()->json(['error' => $validator->errors()->all()]);
                }
            } else {

                $request->merge(['created_at' => date('Y-m-d H:i:s')]);
                $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                $rules = [
                    'clubs_id' => 'required|numeric|exists:clubs,id',
                    'uuidcards_id' => 'required|array|min:1|max:255',
                    'uuidcards_id.*' => 'required|numeric|exists:uuidcards,id|unique:relay_participant_managers,uuidcards_id',
                    'participant_name' => 'required|array|min:1|max:255',
                    'participant_name.*' => 'required',
                ];

                $participant_name = $request->get('participant_name');
                $participant_name_array = explode(',', $participant_name);
                $request->merge(['participant_name' => $participant_name_array]);

                $uuidcards_id = $request->get('uuidcards_id');
                $uuidcards_id_array = explode(',', $uuidcards_id);
                $request->merge(['uuidcards_id' => $uuidcards_id_array]);

                function arrayContainsDuplicate($array)
                {
                    return count($array) != count(array_unique($array));
                }

                $check_uuids_if_are_unique = arrayContainsDuplicate($uuidcards_id_array);


                $data = $request->only(['participant_name', 'uuidcards_id', 'clubs_id', 'created_at', 'updated_at']);
                $validator = Validator::make($data, $rules);


                if($check_uuids_if_are_unique == true){
                    $validator->errors()->add('uuidcards_id.*', 'UUID Card need to be unique for each participant!');
                    return response()->json(['error' => $validator->errors()->all()]);
                }


                if($validator->passes())

                {
                    $club = Club::where('id', $data['clubs_id'])->get()->first();
                    $club_name = $club->club_name;

                    $participant_id = DB::table('relay_participants')->insertGetId(
                        ['clubs_id' => $data['clubs_id'], 'created_at' => $data['created_at'], 'updated_at' => $data['updated_at']]
                    );

                    // Array from ajax
                    $ParticipantsArray = [];
                    $ParticipantsArrayName = [];

                    foreach ($data['participant_name'] as $key => $participant)
                    {
                        $uuid = UuidCard::where('id', $data['uuidcards_id'][$key])->get()->first();

                        $ParticipantsArray[] = [
                            'relay_participant_id' => $participant_id,
                            'participant_name'=> $participant,
                            'uuidcards_id'=> $uuid->id,
                            'created_at'=> date('Y-m-d H:i:s'),
                            'updated_at'=> date('Y-m-d H:i:s'),
                        ];


                        $ParticipantsArrayName[] = $participant . ' (#' . $data['uuidcards_id'][$key] . ' - ' . $uuid->uuid_name . ')';
                    }

                    $ParticipantsArrayName = implode(", ", $ParticipantsArrayName);
                    $relayParticipantManager->createArray($ParticipantsArray);

                    $check_count = RelayParticipant::get()->count();
                    return response()->json(['id' => $participant_id, 'participant_name' => $ParticipantsArrayName, 'club_name' => $club_name, 'check_count' => $check_count, 'success' => 'The new participants have been added.']);

                } else {
                    return response()->json(['error' => $validator->errors()->all()]);
                }
            }
        }  else {
            return redirect('/participants')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function delete($id, Request $request)
    {
        if ( $request->ajax() ) {

            $setting = Setting::findOrFail(1);
            $competition_type = $setting->competition_type;

            if($competition_type === 1){
                Participant::findOrFail($id);
                Participant::where('id', $id)->delete();
                ParticipantStages::where('participants_id', $id)->delete();
                $check_count_participants = Participant::get()->count();
                return response()->json(['check_count_participants' => $check_count_participants, 'success' => 'Great! The Participant has been removed!']);
            } else {
                RelayParticipant::findOrFail($id);
                RelayParticipant::where('id', $id)->delete();
                RelayParticipantManager::where('relay_participant_id', $id)->delete();
                $check_count_participants = RelayParticipant::get()->count();
                return response()->json(['check_count_participants' => $check_count_participants, 'success' => 'Great! The Participants were removed!']);
            }
        } else {
            return redirect('/participants')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function import_log(){
        $stages = Stage::get();
        return view('participants.import-log', compact('stages'));
    }

    public function import_log_import(Request $request)
    {


        $this->validate($request, [

            'import_file' => 'required',
            'stages_id' => 'required|numeric|exists:stages,id',

        ]);


        $setting = Setting::findOrFail(1);
        $competition_type = $setting->competition_type;

        if($competition_type === 1){


            function UUIDWithSpaces($uuid) {
                return preg_replace("/\B(?=(?:[0-9A-F]{2})+\b)/", ' ', $uuid);
            }


            $stages_id = $request->get('stages_id');
            $get_posts = RouteManager::All();
            $get_routes = Route::All();

            $route = [];
            foreach ($get_routes as $key => $get_route){
                $route[$get_route->id] = '';
            }

            foreach ($get_posts as $gets){

                foreach ($route as $key => $gg){

                    if($gets->routes_id == $key){
                        $posts[$key][] = $gets->post_code;
                    }

                }
            }


            if (Input::hasFile('import_file')) {
                $path = Input::file('import_file')->getRealPath();
                $uuid_from_file = "FF FF FF FF";
                $data = array();


                $errors = [];
                //check the UUID from file
                if ($file = fopen($path, "r")) {
                    while(!feof($file)) {
                        $line = fgets($file);

                        if( empty(trim($line)) )
                        {
                            continue;
                        }

                        if(substr( $line, 0, 5 ) === "Card:"){

                            $uuid_from_file = substr($line,6,11);
                            $uuid_from_db = UuidCard::where('uuid_name',$uuid_from_file)->first();

                            //Verify if the UUID exist in db
                            if(!empty($uuid_from_db)) {
                                $participant_stage = ParticipantStages::with('participant')->where('uuidcards_id',$uuid_from_db->id)->where('stages_id', $stages_id)->first();
                                //check if the uuid is enrolled in a stage, if not add the uuid_name in $errors
                                if($participant_stage === NULL){
                                    $errors['stages'][$uuid_from_db['id']] = $uuid_from_db['uuid_name'];
                                }
                            } else {
                                //if UUID doesn't exist in db
                                $errors['uuid'][] = $uuid_from_file;
                            }
                        }
                    }
                }

                if(!empty($errors)){
                    return view('participants.import-log-details', compact('errors'));
                }


                // Data to an array

                if ($file = fopen($path, "r")) {
                    while(!feof($file)) {
                        $line = fgets($file);

                        if( empty(trim($line)) )
                        {
                            continue;
                        }

                        if(substr( $line, 0, 5 ) === "Card:"){

                            $uuid_name_from_file = substr($line,6,11);
                            $uuid_from_db = UuidCard::where('uuid_name', $uuid_name_from_file)->first();
                            $participant_stage = ParticipantStages::where('uuidcards_id', $uuid_from_db->id)->first();
                            $uuid_id = $uuid_from_db->id;

                            $team_name = $participant_stage->participant->club->club_name;
                            $uuid_name = $participant_stage->participant->uuidcard->uuid_name;

                            // Array pentru fiecare UUID
                            $data[$uuid_id]['uuidcards_id'] = $uuid_id;
                            $data[$uuid_id]['uuid_name'] = $uuid_from_db->uuid_name;
                            $data[$uuid_id]['team_name'] = $team_name;
                            $data[$uuid_id]['participant_stage_id'] = $participant_stage->id;
                            $data[$uuid_id]['participant_name'] = $participant_stage->participant->participant_name;
                            $data[$uuid_id]['category_id'] = $participant_stage->category->id;
                            $data[$uuid_id]['category_name'] = $participant_stage->category->category_name;
                            $data[$uuid_id]['route_id'] = $participant_stage->category->route->id;
                            $data[$uuid_id]['route_name'] = $participant_stage->category->route->route_name;
                            $data[$uuid_id]['posts_validated'] = $posts[ $participant_stage->category->route->id];

                        } else {
                            // Grupare post/timestamp/data si creare array
                            $parts = explode(",",$line);

                            foreach ( $parts as $key => $part )
                            {
                                if( trim($parts[$key]) == '%' || $key % 2 != 0  )
                                {
                                    continue;
                                }
                                $data[$uuid_id]['posts_to_be_validated'][] = array( "post"=> $parts[$key], "time" => $parts[$key+1]);
                            }
                        }
                    }
                    fclose($file);
                }


                if (!empty($data)) {

                    $response_data = [];
                    $response_data_number = 0;

                    foreach ($data as $cardUuid => $time_and_posts ) {
                        $response_data[$cardUuid]['participant_name'] = $time_and_posts['participant_name'];
                        $response_data[$cardUuid]['team_name'] = $time_and_posts['team_name'];
                        $response_data[$cardUuid]['uuid_id'] = $time_and_posts['uuidcards_id'];
                        $response_data[$cardUuid]['uuid_name'] = $time_and_posts['uuid_name'];
                        $response_data[$cardUuid]['category'] = $time_and_posts['category_name'];

                        $missing_posts = [];
                        $valid_posts = [];

                        $total_posts = count($time_and_posts['posts_validated']);
                        $number_of_posts_taked = count($time_and_posts['posts_to_be_validated']);

                        $start_time = 0;
                        $final_time = 0;

                        for ($i = 0; $i < $total_posts; $i++) {

                            foreach ($time_and_posts['posts_to_be_validated'] as $order => $time_and_post) {

                                if ($time_and_post['post'] == $time_and_posts['posts_validated'][$i] ) {

                                    if( $time_and_post['post'] == 251 && $start_time == 0 )
                                    {
                                        $start_time = $time_and_post['time'];
                                    }

                                    if( $time_and_post['post'] == 252 && $final_time == 0 )
                                    {
                                        $final_time = $time_and_post['time'];
                                    }

                                    if(  $i != 0  )
                                    {
                                        if ( isset($valid_posts[$time_and_posts['posts_validated'][$i-1]]) && $time_and_post['time'] >= $valid_posts[$time_and_posts['posts_validated'][$i-1]]  )
                                        {
                                            if( empty($valid_posts[$time_and_post['post']]) )
                                            {
                                                $valid_posts[$time_and_post['post']] = $time_and_post['time'];
                                            }
                                            break;
                                        }
                                    }
                                    else
                                    {
                                        if( empty($valid_posts[$time_and_post['post']]) )
                                        {
                                            $valid_posts[$time_and_post['post']] = $time_and_post['time'];
                                        }
                                        break;
                                    }

                                }

                                if ($number_of_posts_taked - 1 == $order) {
                                    $missing_posts[] = $time_and_posts['posts_validated'][$i];
                                }
                            }

                        }


                        if( empty($missing_posts) )
                        {
                            $response_data[$cardUuid]['posts_correct'] = [];
                            $response_data[$cardUuid]['posts_participant'] = [];
                            $response_data[$cardUuid]['posts_missed'] = [];
                        }
                        else
                        {
                            foreach ( $missing_posts as $missing_post )
                            {
                                $response_data[$cardUuid]['posts_missed'][] = $missing_post;

                            }
                            foreach ( $time_and_posts['posts_validated'] as $item )
                            {
                                $response_data[$cardUuid]['posts_correct'][] = $item;
                            }
                            foreach ( $time_and_posts['posts_to_be_validated'] as $order => $value )
                            {
                                $response_data[$cardUuid]['posts_participant'][$value['post']] = date('H:i:s',$value['time']);

                            }
                        }
                        $missing_posts = implode(",", $missing_posts);
                        $missing_posts_text = ( empty($missing_posts) ) ? '' : $missing_posts;
                        if( !empty($uuid_from_db) )
                        {
                            DB::table('participant_stages')
                                ->where('uuidcards_id', $time_and_posts['uuidcards_id'])
                                ->where('stages_id', $stages_id)
                                ->update(['start_time' => date('H:i:s',$start_time), 'finish_time' => date('H:i:s',$final_time), 'total_time' => date('H:i:s',$final_time - $start_time), 'abandon' => 0, 'missed_posts' => $missing_posts_text, 'order_posts' => json_encode($time_and_posts['posts_to_be_validated'])]);
                        }
                    }
                }
            }

            //dd($response_data);
            $nr = 1;
            $stage = Stage::where('id', $stages_id)->get()->first();
            $stage_name = $stage->stage_name;
            $filename_location =  'download/stage-'. $stages_id .'.pdf';

            PDF::loadView('participants.import-log-pdf', ['response_data' => $response_data, 'nr' => $nr, 'stage_name' => $stage_name])->setPaper('a4', 'landscape')->save($filename_location);

            DB::table('stages')
                ->where('id', $stages_id)
                ->update(['filename' => $filename_location]);

            $errors = [];

            return view('participants.import-log-details', compact('response_data', 'errors'));

        } else {


            function UUIDWithSpaces($uuid) {
                return preg_replace("/\B(?=(?:[0-9A-F]{2})+\b)/", ' ', $uuid);
            }


            $stages_id = $request->get('stages_id');
            $get_posts = RouteManager::All();
            $get_routes = Route::All();

            $route = [];
            foreach ($get_routes as $key => $get_route){
                $route[$get_route->id] = '';
            }

            foreach ($get_posts as $gets){

                foreach ($route as $key => $gg){

                    if($gets->routes_id == $key){
                        $posts[$key][] = $gets->post_code;
                    }

                }
            }


            if (Input::hasFile('import_file')) {
                $path = Input::file('import_file')->getRealPath();
                $uuid_from_file = "FF FF FF FF";
                $data = array();


                $errors = [];
                //check the UUID from file
                if ($file = fopen($path, "r")) {
                    while(!feof($file)) {
                        $line = fgets($file);

                        if( empty(trim($line)) )
                        {
                            continue;
                        }

                        if(substr( $line, 0, 5 ) === "Card:"){

                            $uuid_from_file = substr($line,6,11);
                            $uuid_from_db = UuidCard::where('uuid_name',$uuid_from_file)->first();

                            //Verify if the UUID exist in db
                            if(!empty($uuid_from_db)) {
                                $participant_stage = RelayParticipantStage::with('participant')->where('uuidcards_id',$uuid_from_db->id)->where('stages_id', $stages_id)->first();
                                //check if the uuid is enrolled in a stage, if not add the uuid_name in $errors
                                if($participant_stage === NULL){
                                    $errors['stages'][$uuid_from_db['id']] = $uuid_from_db['uuid_name'];
                                }
                            } else {
                                //if UUID doesn't exist in db
                                $errors['uuid'][] = $uuid_from_file;
                            }
                        }
                    }
                }


                if(!empty($errors)){
                    return view('participants.import-log-details', compact('errors'));
                }


                // Data to an array

                if ($file = fopen($path, "r")) {
                    while(!feof($file)) {
                        $line = fgets($file);

                        if( empty(trim($line)) )
                        {
                            continue;
                        }

                        if(substr( $line, 0, 5 ) === "Card:"){

                            $uuid_name_from_file = substr($line,6,11);
                            $uuid_from_db = UuidCard::where('uuid_name', $uuid_name_from_file)->first();
                            $participant_stage = RelayParticipantStage::with('participant_stage', 'participant', 'category', 'route')->where('uuidcards_id', $uuid_from_db->id)->first();
                            $uuid_id = $uuid_from_db->id;

                            $team_name = $participant_stage->participant->club->club_name;
                            $uuid_name = $participant_stage->participant_stage->uuidcard->uuid_name;


                            // Array pentru fiecare UUID
                            $data[$uuid_id]['uuidcards_id'] = $uuid_id;
                            $data[$uuid_id]['uuid_name'] = $uuid_from_db->uuid_name;
                            $data[$uuid_id]['team_name'] = $team_name;
                            $data[$uuid_id]['participant_stage_id'] = $participant_stage->id;
                            $data[$uuid_id]['participant_name'] = $participant_stage->participant_stage->participant_name;
                            $data[$uuid_id]['category_id'] = $participant_stage->category->id;
                            $data[$uuid_id]['category_name'] = $participant_stage->category->category_name;
                            $data[$uuid_id]['route_id'] = $participant_stage->route->id;
                            $data[$uuid_id]['route_name'] = $participant_stage->route->route_name;
                            $data[$uuid_id]['posts_validated'] = $posts[ $participant_stage->route->id];

                        } else {
                            // Grupare post/timestamp/data si creare array
                            $parts = explode(",",$line);

                            foreach ( $parts as $key => $part )
                            {
                                if( trim($parts[$key]) == '%' || $key % 2 != 0  )
                                {
                                    continue;
                                }
                                $data[$uuid_id]['posts_to_be_validated'][] = array( "post"=> $parts[$key], "time" => $parts[$key+1]);
                            }
                        }
                    }
                    fclose($file);
                }


                if (!empty($data)) {

                    $response_data = [];
                    $response_data_number = 0;

                    foreach ($data as $cardUuid => $time_and_posts ) {
                        $response_data[$cardUuid]['participant_name'] = $time_and_posts['participant_name'];
                        $response_data[$cardUuid]['team_name'] = $time_and_posts['team_name'];
                        $response_data[$cardUuid]['uuid_id'] = $time_and_posts['uuidcards_id'];
                        $response_data[$cardUuid]['uuid_name'] = $time_and_posts['uuid_name'];
                        $response_data[$cardUuid]['category'] = $time_and_posts['category_name'];

                        $missing_posts = [];
                        $valid_posts = [];

                        $total_posts = count($time_and_posts['posts_validated']);
                        $number_of_posts_taked = count($time_and_posts['posts_to_be_validated']);

                        $start_time = 0;
                        $final_time = 0;

                        for ($i = 0; $i < $total_posts; $i++) {

                            foreach ($time_and_posts['posts_to_be_validated'] as $order => $time_and_post) {

                                if ($time_and_post['post'] == $time_and_posts['posts_validated'][$i] ) {

                                    if( $time_and_post['post'] == 251 && $start_time == 0 )
                                    {
                                        $start_time = $time_and_post['time'];
                                    }

                                    if( $time_and_post['post'] == 252 && $final_time == 0 )
                                    {
                                        $final_time = $time_and_post['time'];
                                    }

                                    if(  $i != 0  )
                                    {
                                        if ( isset($valid_posts[$time_and_posts['posts_validated'][$i-1]]) && $time_and_post['time'] >= $valid_posts[$time_and_posts['posts_validated'][$i-1]]  )
                                        {
                                            if( empty($valid_posts[$time_and_post['post']]) )
                                            {
                                                $valid_posts[$time_and_post['post']] = $time_and_post['time'];
                                            }
                                            break;
                                        }
                                    }
                                    else
                                    {
                                        if( empty($valid_posts[$time_and_post['post']]) )
                                        {
                                            $valid_posts[$time_and_post['post']] = $time_and_post['time'];
                                        }
                                        break;
                                    }

                                }

                                if ($number_of_posts_taked - 1 == $order) {
                                    $missing_posts[] = $time_and_posts['posts_validated'][$i];
                                }
                            }

                        }


                        if( empty($missing_posts) )
                        {
                            $response_data[$cardUuid]['posts_correct'] = [];
                            $response_data[$cardUuid]['posts_participant'] = [];
                            $response_data[$cardUuid]['posts_missed'] = [];
                        }
                        else
                        {
                            foreach ( $missing_posts as $missing_post )
                            {
                                $response_data[$cardUuid]['posts_missed'][] = $missing_post;

                            }
                            foreach ( $time_and_posts['posts_validated'] as $item )
                            {
                                $response_data[$cardUuid]['posts_correct'][] = $item;
                            }
                            foreach ( $time_and_posts['posts_to_be_validated'] as $order => $value )
                            {
                                $response_data[$cardUuid]['posts_participant'][$value['post']] = date('H:i:s',$value['time']);

                            }
                        }
                        $missing_posts = implode(",", $missing_posts);
                        $missing_posts_text = ( empty($missing_posts) ) ? '' : $missing_posts;
                        if( !empty($uuid_from_db) )
                        {
                            DB::table('relay_participant_stages')
                                ->where('uuidcards_id', $time_and_posts['uuidcards_id'])
                                ->where('stages_id', $stages_id)
                                ->update(['start_time' => date('H:i:s',$start_time), 'finish_time' => date('H:i:s',$final_time),
                                    'total_time' => date('H:i:s',$final_time - $start_time), 'abandon' => 0,
                                    'missed_posts' => $missing_posts_text, 'order_posts' => json_encode($time_and_posts['posts_to_be_validated'])]);
                        }
                    }
                }
            }

            //dd($response_data);
            $nr = 1;
            $stage = Stage::where('id', $stages_id)->get()->first();
            $stage_name = $stage->stage_name;
            $filename_location =  'download/stage-'. $stages_id .'.pdf';

            PDF::loadView('participants.import-log-pdf', ['response_data' => $response_data, 'nr' => $nr, 'stage_name' => $stage_name])->setPaper('a4', 'landscape')->save($filename_location);

            DB::table('stages')
                ->where('id', $stages_id)
                ->update(['filename' => $filename_location]);

            $errors = [];

            return view('participants.import-log-details', compact('response_data', 'errors'));
        }

    }

}

