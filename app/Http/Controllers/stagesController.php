<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use DB;
use Session;
use Input;

class stagesController extends Controller
{
    public function index(){

        $stageslist = DB::table('stages')->paginate(15);


        return view('stages', ['stageslist' => $stageslist]);


    }



    public function create(Request $request){


            $stage_name = $_POST['stage_name'];
            $stage_date = $_POST['stage_date'];
            $stage_time = $_POST['stage_time'];

        $this->validate($request, ['stage_name' => 'required|filled|min:1|max:255|unique:stages,stage_name']);

        foreach($stage_name as $key => $value) {

            $stagename = $stage_name[$key];
            $stagedate = $stage_date[$key];
            $stagetime = $stage_time[$key];



            DB::table('stages')->insertGetId(
                [
                    'stage_name' => $stagename, 'stage_date' => $stagedate, 'stage_time' => $stagetime
                ]
            );

        }

        $count =  count($stage_name);

        if ($count > 1 ) {
            return redirect('/stages')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>All stages have been added to the database.</div>');
        } else {
            return redirect('/stages')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>One stage has been added to the database.</div>');
        }

    }


    public function remove($id) {

        DB::table('stages')->where('id', $id)->delete();

        $data = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Stage with <strong>ID ' . $id . '</strong> has been removed from database.</div>';
        return redirect('/stages')->with('message', $data);
    }


    public function truncate() {

        DB::table('stages')->truncate();

        return redirect('/stages')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>All Stages has been removed from database.</div>');
    }


    public function edit($id){

        $stage = DB::table('stages')
            ->select('id', 'stage_name', 'stage_date', 'stage_time')
            ->where('id', '=', $id)
            ->first();


        return view('stages.edit', ['stage' => $stage]);


    }

    public function update(Request $request, $id){


        $stage_name = $request->input('stage_name');
        $stage_date = $request->input('stage_date');
        $stage_time = $request->input('stage_time');


        DB::table('stages')
            ->where('id', '=', $id)
            ->update(['stage_name' => $stage_name, 'stage_date' => $stage_date, 'stage_time' => $stage_time]);

        $result = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>The Stage with #ID " . $id .  " have been added updated.</div>";
        return redirect('/stages')->with('message', $result);

    }




}
