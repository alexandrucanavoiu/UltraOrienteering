<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use DB;
use Session;
use Input;
use App\Models\Club;
use App\Models\ClubDistrict;

class clubsController extends Controller
{
    public function index(){

        $clubs = Club::with('ClubDistrict')->paginate(15);

        $districtlist = ClubDistrict::All();

        return view('clubs', ['clubs' => $clubs, 'districtlist' => $districtlist]);


    }



    public function create(Request $request){

        $cname = $request->input('name');
        $ccity = $request->input('city');
        $cdistrict = $request->input('district');

        foreach($cname as $key => $value) {

            $clubname = $cname[$key];
            $clubcity = $ccity[$key];
            $clubdistrict = $cdistrict[$key];


            $clubs = Club::create([
                'name' => $clubname,
                'city' => $clubcity,
                'route_id' => $clubdistrict
            ]);
        }

        $count =  count($cname);

        if ($count > 1 ) {
            return redirect('/clubs')->with('success', 'All clubs have been added to the database.');
        } else {
            return redirect('/clubs')->with('success', 'Club ' . $club->name . ' has been added to the database.');
        }
    }


    public function remove($id) {

        $club = Club::findOrFail($id);
        $club->delete();

        return redirect('/clubs')->with('success', $club->name . ' has been removed from the database');
    }


    public function edit($id){

        $club = Club::with('ClubDistrict')->findOrFail($id);
        $districtlist = ClubDistrict::All();

        return view('clubs.edit', ['club' => $club, 'districtlist' => $districtlist]);


    }

    public function update(Request $request, $id){

        $club = Club::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:255|min:2',
            'city' => 'required|min:2',
            'district' => 'required|integer',
        ]);

        $club->update([
            'name' => $request->input('name'),
            'club_district_id' => $request->input('district'),
            'city' => $request->input('city')

        ]);

            return redirect('/clubs')->with('success', $club->name . ' have been added updated.');

    }
}
