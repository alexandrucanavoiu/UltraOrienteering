<?php

namespace App\Http\Controllers;

use App\Models\ParticipantStages;
use Illuminate\Http\Request;
use Validator;
use DB;
use Session;
use Input;
use App\Models\Stage;

class stagesController extends Controller
{
    public function index(){

        $stageslist = Stage::paginate(15);

        return view('stages.index', ['stageslist' => $stageslist]);
    }


    public function create(Request $request)
    {
        if( $request->ajax() )
        {
            return view('stages.create');

        }  else {
            return redirect('/stages')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function store(Request $request)
    {
        if( $request->ajax() )
        {
            $request->merge(['created_at' => date('Y-m-d H:i:s')]);
            $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
            $rules = [
                'stage_name' => 'required|max:255|min:3',
            ];

            $data = $request->only(['stage_name', 'created_at', 'updated_at']);
            $validator = Validator::make($data, $rules);

            if($validator->passes())

            {
                $save = Stage::create($data);
                $check_count = Stage::get()->count();
                return response()->json(['id' => $save->id, 'stage_name' => $save->stage_name, 'check_count' => $check_count, 'success' => 'The new stage has been added.']);


            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }
        }  else {
            return redirect('/stages')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function edit($id){

        $stage =  Stage::findOrFail($id);

        return view('stages.edit', ['stage' => $stage]);


    }

    public function update(Request $request, $id)
    {
        if( $request->ajax() )
        {
            $stage = Stage::findOrFail($id);
            $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
            $rules = [
                'stage_name' => 'required|max:255|min:2',
            ];
            $data = $request->only(['stage_name', 'updated_at']);

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $stage->update($data);
                $stage_name = $stage->stage_name;
                return response()->json(['success' => 'Great! The Stage has been updated.', 'id' => $stage->id, 'stage_name' => $stage_name]);

            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }
        }  else {
            return redirect('/clubs')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function delete($id, Request $request)
    {
        if ( $request->ajax() ) {
            Stage::findOrFail($id);

            $count_used_categories = ParticipantStages::where('stages_id', $id)->get()->count();
            $check_count = Stage::get()->count();
            if($count_used_categories === 0) {
                Stage::where('id', $id)->delete();
                return response()->json(['check_count' => $check_count, 'success' => 'Great! The Stage has been removed!']);
            } else {
                return response()->json(['check_count' => $check_count, 'warning' => 'Error! This Stage is associated!'], 405);
            }

        } else {
            return redirect('/participants')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

}
