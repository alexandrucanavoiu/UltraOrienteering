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
                'duration' => $stagetime,
            ]);

            
        }

        $count =  count($stage_name);

        if ($count > 1 ) {
            return redirect('/stages')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>All stages have been added to the database.</div>');
        } else {
            return redirect('/stages')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>One stage has been added to the database.</div>');
        }

    }


    public function remove($id) {

        Stage::where('id', $id)->delete();

        $data = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Stage with <strong>ID ' . $id . '</strong> has been removed from database.</div>';
        return redirect('/stages')->with('message', $data);
    }


    public function truncate() {

        DB::table('stages')->truncate();

        return redirect('/stages')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>All Stages has been removed from database.</div>');
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

        $result = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>The Stage with #ID " . $id .  " have been added updated.</div>";
        return redirect('/stages')->with('message', $result);

    }




}
