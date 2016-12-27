<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use DB;
use Session;
use Input;
use App\Models\Stage;

class stagesController extends Controller
{
    public function index(){

        $stageslist = Stage::paginate(15);

        return view('stages', ['stageslist' => $stageslist]);


    }



    public function create(Request $request){


            $stage_name = $request->input('stage_name');
            $stage_date = $request->input('stage_date');
            $stage_time = $request->input('stage_time');


        foreach($stage_name as $key => $value) {

            $stagename = $stage_name[$key];
            $stagedate = $stage_date[$key];
            $stagetime = $stage_time[$key];


            $stage = Stage::create([
                'name' => $stagename,
                'start_time' => $stagedate,
                'duration' => $stagetime
            ]);


        }

        $count =  count($stage_name);

        if ($count > 1 ) {
            return redirect('/stages')->with('success', 'All stages have been added to the database.');
        } else {
            return redirect('/stages')->with('success', $stage->name . ' has been added to the database.');
        }

    }


    public function remove($id) {

        $stage =  Stage::find($id);
        if (!$stage) {  return redirect('/stages')->with('error', 'You cannot remove the stage with id ' . $id . ' becouse not exist! '); }

        $stage->delete();

        return redirect('/stages')->with('success', $stage->name . ' has been removed!');
    }



    public function edit($id){

        $stage =  Stage::find($id);

        if (!$stage) {  return redirect('/stages')->with('error', 'You cannot edit the stage with id ' . $id . ' becouse not exist! '); }

        return view('stages.edit', ['stage' => $stage]);


    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'stage_name' => 'required',
        ]);

        $stage = Stage::find($id);

        if (!$stage) {  return redirect('/stages')->with('error', 'You cannot update the stage with id ' . $id . ' becouse not exist! '); }

        $stage->update([
            'name' => $request->input('stage_name'),
            'start_time' => $request->input('stage_date'),
            'duration' => $request->input('stage_time')
        ]);

        return redirect('/stages')->with('success', $stage->name . ' have been updated');

    }




}
