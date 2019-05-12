<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Validator;
use DB;
use Input;
use App\Models\UuidCard;
use Excel;
use Yajra\Datatables\Datatables;

            class uuidcardsController extends Controller
            {

                public function index(){
                    $uuidcards = UuidCard::get();
                    return view('uuidcards.index', compact('uuidcards'));
                }

                public function index_anyData_all()
                {
                    $uuidcards = UuidCard::get();
                    return Datatables::of($uuidcards)
                        ->make(true);
                }

                public function edit(Request $request, $id)
                {
                    if( $request->ajax() )
                    {
                        $uuidcard = UuidCard::findOrFail($id);
                        return view('uuidcards.edit', compact('uuidcard'));
                    }  else {
                        return redirect('/uuid-cards')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
                    }
                }

                public function update(Request $request, $id)
                {
                    if( $request->ajax() )
                    {
                        $uuid_card = UuidCard::findOrFail($id);
                        $rules = [
                            'uuid_name' => 'required|max:255|min:3',
                        ];
                        $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                        $data = $request->only(['uuid_name']);
                        $validator = Validator::make($data, $rules);

                        // TODO: Validate uuid to be like: 03 1F 3D C2

                        if ($validator->passes()) {
                            $uuid_card->update($data);
                            return response()->json(['success' => 'The UUID CARD has been updated.', 'uuid_name' => $uuid_card->uuid_name, 'id' => $uuid_card->id]);

                        } else {
                            return response()->json(['error' => $validator->errors()->all()]);
                        }
                    }  else {
                        $notification = array(
                            'message' => 'Ilegal operation.',
                            'alert-type' => 'error'
                        );
                        return redirect()->route('uuid-cards')->with($notification);
                    }


                }

                public function delete($id, Request $request)
                {
                    if ( $request->ajax() ) {
                        UuidCard::findOrFail($id);
                        $participant = Participant::where('id', $id)->get()->count();
                        if($participant == 0){
                            UuidCard::where('id', $id)->delete();
                            $check_count_uuid_cards = UuidCard::get()->count();
                            return response()->json(['check_count_uuid_cards' => $check_count_uuid_cards, 'success' => 'Great! The UUID CARD has been removed!']);
                        } else {
                            return response()->json(['warning' => 'This UUID CARD is assigned.'], 405);
                        }
                    } else {
                        $notification = array(
                            'message' => 'Ilegal operation..',
                            'alert-type' => 'error'
                        );
                        return redirect()->route('uuid-cards')->with($notification);
                    }
                }

                public function clean(Request $request){
                    if( $request->ajax() )
                    {
                        $uuidcards_used = Participant::get()->count();
                        if($uuidcards_used === 0){
                            DB::statement("SET foreign_key_checks=0");
                            UuidCard::truncate();
                            DB::statement("SET foreign_key_checks=1");
                            return redirect('/uuid-cards')->with(['alert-type' => 'success', 'message' => 'All UUID CARDS Deleted!']);
                        } else {
                            return response()->json(['warning' => 'Error! One or more UUID CARDS are associated!'], 405);
                        }
                    }  else {
                        return redirect('/uuid-cards')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
                    }
                }

                public function importExcel(Request $request)

                {

                    $rules = [

                        'import_file' => 'required'
                    ];

                    $data = $request->only(['import_file']);
                    $validator = Validator::make($data, $rules);

                    if ($validator->passes()) {
                        if (Input::hasFile('import_file')) {

                            $path = Input::file('import_file')->getRealPath();

                            $data = Excel::load($path, function ($reader) {
                                $reader->noHeading();
                            })->get();


                            if (!empty($data) && $data->count()) {
                                foreach ($data as $key => $value) {
                                    $cell_items = $value->toArray();
                                    $first_item = reset($cell_items);

                                    if (Uuidcard::where('uuid_name', $first_item)->exists()) {
                                        return redirect('/uuid-cards')->with(['alert-type' => 'error', 'message' => 'Please verify the UUIDCARD from UUID Cards List with the File Imported, same are duplicate.']);
                                    }

                                    $insert = ['uuid_name' => $first_item];

                                    if (!empty($insert)) {
                                        UuidCard::insert($insert);
                                    }
                                }

                                return redirect('/uuid-cards')->with('success', 'UUID Cards from file has imported successed.');

                            }
                        } else {
                            return redirect('/uuid-cards')->with(['alert-type' => 'warning', 'message' => 'Did you upload the corect format?']);
                        }
                    } else {
                        return redirect('/uuid-cards')->with(['alert-type' => 'warning', 'message' => 'Did you upload the corect format?']);
                    }

    }

                public function downloadExcel($type)

                {

                    $data = Uuidcard::get()->toArray();

                    return Excel::create('ultra_orienteering', function($excel) use ($data) {

                        $excel->sheet('mySheet', function($sheet) use ($data)

                        {

                            $sheet->fromArray($data);

                        });

                    })->download($type);

                }
}
