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


            $stage_name = $_POST['stage_name'];
            $stage_date = $_POST['stage_date'];
            $stage_time = $_POST['stage_time'];


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

        $stage =  Stage::findOrFail($id);
        $stage->delete();

        return redirect('/stages')->with('success', $stage->name . ' has been removed!');
    }



    public function edit($id){

        $stage =  Stage::findOrFail($id);

        return view('stages.edit', ['stage' => $stage]);


    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'stage_name' => 'required',
        ]);

        $stage = Stage::findOrFail($id);
        $stage->update([
            'name' => $request->input('stage_name'),
            'start_time' => $request->input('stage_date'),
            'duration' => $request->input('stage_time')
        ]);

        return redirect('/stages')->with('success', $stage->name . ' have been updated');

    }




}
