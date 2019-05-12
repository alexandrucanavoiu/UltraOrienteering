<?php

namespace App\Http\Controllers;

use Dompdf\Exception;
use Illuminate\Http\Request;
use Validator;
use DB;
use Session;
use Input;
use App\Models\Club;
use Yajra\Datatables\Datatables;
use App\Models\Participant;

class clubsController extends Controller
{
    public function index(){
        $clubs = Club::Orderby('club_name', 'ASC')->paginate(100);
        return view('clubs.index', ['clubs' => $clubs]);
    }

    public function index_anyData_all()
    {
        $clubs = Club::get();
        return Datatables::of($clubs)
            ->setRowClass(function ($clubs) {
                return 'clubs-list-' . $clubs->id;
            })
            ->make(true);
    }

    public function create(){
        return view('clubs.create');
    }

    public function store(Request $request)
    {
        if( $request->ajax() )
        {
            $request->merge(['created_at' => date('Y-m-d H:i:s')]);
            $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
            $rules = [
                'club_name' => 'required|max:255|min:3',
                'city' => 'required|max:255|min:3',
            ];

            $data = $request->only(['club_name', 'city', 'created_at', 'updated_at']);
            $validator = Validator::make($data, $rules);

            if($validator->passes())

            {
                $save = Club::create($data);
                $check_count = Club::get()->count();
                return response()->json(['id' => $save->id, 'club_name' => $save->club_name, 'city' => $save->city, 'check_count' => $check_count, 'success' => 'The new club has been added.']);


            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }
        }  else {
            return redirect('/clubs')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function edit(Request $request, $id)
    {
        if( $request->ajax() )
        {
            $club = Club::findOrFail($id);
            return view('clubs.edit', compact('club'));
        }  else {
            return redirect('/clubs')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function update(Request $request, $id)
    {
        if( $request->ajax() )
        {
            $club = Club::findOrFail($id);
            $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
            $rules = [
                'club_name' => 'required|max:255|min:2',
                'city' => 'required|max:255|min:2',
            ];
            $data = $request->only(['club_name', 'city', 'updated_at']);

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $club->update($data);
                $club_name = $club->club_name;
                $city = $club->city;
                return response()->json(['success' => 'Great! The Club has been updated.', 'id' => $club->id, 'club_name' => $club_name,  'city' => $city]);

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
            Club::findOrFail($id);
            $participant_use_club = Participant::where('clubs_id', $id)->count();
            $check_count = Club::get()->count();

            if($participant_use_club === 0){
                Club::where('id', $id)->delete();
                return response()->json(['check_count' => $check_count, 'success' => 'Great! The Club has been removed!']);
            } else {
                return response()->json(['check_count' => $check_count, 'warning' => 'Error! This Club is associated!'], 405);

            }

        } else {
            return redirect('/clubs')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

}
