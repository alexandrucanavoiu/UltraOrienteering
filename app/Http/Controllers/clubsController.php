<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use DB;
use Session;
use Input;

class clubsController extends Controller
{
    public function index(){

        $clubs = DB::table('clubs')
            ->select('clubs.id as club_id', 'clubs.club_name', 'clubs.club_city', 'clubs.club_district', 'district.id as district_id', 'district.district_name')
            ->leftJoin('district', 'district.id', '=', 'clubs.club_district')
            ->paginate(15);

        $districtlist = DB::table('district')->get();


        return view('clubs', ['clubs' => $clubs, 'districtlist' => $districtlist]);


    }



    public function create(Request $request){

        $cname = $_POST['name'];
        $ccity = $_POST['city'];
        $cdistrict = $_POST['district'];


       // $this->validate($request, ['name' => 'required|filled|min:2|max:255|unique:clubs,name']);

        foreach($cname as $key => $value) {

            $clubname = $cname[$key];
            $clubcity = $ccity[$key];
            $clubdistrict = $cdistrict[$key];



            DB::table('clubs')->insertGetId(
                [
                    'club_name' => $clubname, 'club_city' => $clubcity, 'club_district' => $clubdistrict
                ]
            );


        }

        $count =  count($cname);


        if ($count > 1 ) {
            return redirect('/clubs')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>All clubs have been added to the database.</div>');
        } else {
            return redirect('/clubs')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>One club has been added to the database.</div>');
        }

    }


    public function remove($id) {

        DB::table('clubs')->where('id', $id)->delete();

        $data = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Club with <strong>ID ' . $id . '</strong> has been removed from the database.</div>';
        return redirect('/clubs')->with('message', $data);
    }


    public function truncate() {

        DB::table('clubs')->truncate();

        return redirect('/clubs')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>All Clubs has been removed from the database.</div>');
    }


    public function edit($id){

        $clubs = DB::table('clubs')
            ->select('clubs.id as club_id', 'clubs.club_name', 'clubs.club_city', 'clubs.club_district', 'district.id as district_id', 'district.district_name')
            ->leftJoin('district', 'district.id', '=', 'clubs.club_district')
            ->where('clubs.id', '=', $id)
            ->first();

        $districtlist = DB::table('district')->get();


        return view('clubs.edit', ['clubs' => $clubs, 'districtlist' => $districtlist]);


    }



    public function update(Request $request, $id){


        $name = $request->input('name');
        $city = $request->input('city');
        $district = $request->input('district');


        DB::table('clubs')
            ->where('clubs.id', '=', $id)
            ->update(['club_name' => $name, 'club_city' => $city, 'club_district' => $district]);

            $result = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>Club with #ID " . $id .  " have been added updated.</div>";
            return redirect('/clubs')->with('message', $result);

    }



}
