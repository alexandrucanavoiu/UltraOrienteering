<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use DB;
use Session;
use Input;
use App\Uuidcard;
use Excel;

class uuidcardsController extends Controller
{
    public function index(){

        $uuidcardslist = DB::table('uuidcards')->paginate(15);

       return view('uuid-cards', ['uuidcardslist' => $uuidcardslist]);


    }

    public function remove($id) {

        DB::table('uuidcards')->where('id', $id)->delete();

        $data = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> UUID Card with <strong>number ' . $id . '</strong> has removed from database.</div>';
        return redirect('/uuid-cards')->with('message', $data);
    }


    public function trucate() {



        DB::table('uuidcards')->truncate();


        return redirect('/uuid-cards')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>All information from database for UUID Cards removed</div>');
    }



    public function validateImportFile(Request $request) {

        $this->validate($request, [

            'import_file' => 'required'

            ]);

    }


    public function importExport()

    {

        return view('importExport');

    }

    public function downloadExcel($type)

    {

        $data = Uuidcard::get()->toArray();

        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {

            $excel->sheet('mySheet', function($sheet) use ($data)

            {

                $sheet->fromArray($data);

            });

        })->download($type);

    }

    public function importExcel()

    {
            if (Input::hasFile('import_file')) {

                $path = Input::file('import_file')->getRealPath();

                $data = Excel::load($path, function ($reader) {

                })->get();

                if (!empty($data) && $data->count()) {

                    foreach ($data as $key => $value) {

                        if (is_null($value->uuidcard) || is_null($value->id)) {

                            return redirect('/uuid-cards')->with('message', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Error Import File, please read the documentation about import uuid cards in database</div>');

                        }

                        if (Uuidcard::where('id', $value->id)->exists()) {
                            return redirect('/uuid-cards')->with('message', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Please verify the ID from UUID Cards List with the File Imported, same to be duplicate.</div>');
                        }

                        if (Uuidcard::where('uuidcard', $value->uuidcard)->exists()) {
                            return redirect('/uuid-cards')->with('message', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Please verify the UUIDCARD from UUID Cards List with the File Imported, same to be duplicate.</div>');
                        }


                        $insert[] = ['id' => $value->id, 'uuidcard' => $value->uuidcard];

                    }

                    if (!empty($insert)) {

                        DB::table('uuidcards')->insert($insert);

                        return redirect('/uuid-cards')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>UUID Cards from file has imported successed.</div>');

                    }

                }

            }


        return back();

    }


}
