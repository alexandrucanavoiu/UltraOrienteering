<?php

namespace App\Http\Controllers;

use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use DB;
use Session;
use Input;
use App\Models\UuidCard;
use Excel;

class uuidcardsController extends Controller
{
    public function index(){

        $uuidcardslist = UuidCard::paginate(15);

        return view('uuid-cards', ['uuidcardslist' => $uuidcardslist]);

    }

    public function remove($id, Exception $e) {

        $uuid = UuidCard::findOrFail($id);

                    try {
                        $uuid->delete();
                    } catch(\Exception $e) {
                        if (stristr($e->getMessage(), 'Cannot delete or update a parent row: a foreign key constraint fails')) {
                            return redirect('/uuid-cards')->with('warning', 'UUID Card with ID '. $uuid->uuidcard . '  cannot be deleted because it has related entities. Please first remove all the other dates that uses this record...');
                        }
                    }

        return redirect('/uuid-cards')->with('success', 'UUID Card with ID' . $uuid->uuidcard . ' has removed from database.');
    }

    public function importExport()

    {

        return view('importExport');

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

    public function importExcel(Request $request)

    {

        $this->validate($request, [

            'import_file' => 'required'

        ]);

        if (Input::hasFile('import_file')) {

            $path = Input::file('import_file')->getRealPath();

            $data = Excel::load($path, function ($reader) {

            })->get();

            if (!empty($data) && $data->count()) {

                foreach ($data as $key => $value) {

                    if (is_null($value->uuidcard) || is_null($value->id)) {

                        return redirect('/uuid-cards')->with('warning', 'Error Import File, please read the documentation about import uuid cards in database');

                    }

                    if (Uuidcard::where('id', $value->id)->exists()) {
                        return redirect('/uuid-cards')->with('warning', 'Please verify the ID from UUID Cards List with the File Imported, same to be duplicate.');
                    }

                    if (Uuidcard::where('uuidcard', $value->uuidcard)->exists()) {
                        return redirect('/uuid-cards')->with('warning', 'Please verify the UUIDCARD from UUID Cards List with the File Imported, same to be duplicate.');
                    }

                    $insert[] = ['id' => $value->id, 'uuidcard' => $value->uuidcard];
                }

                if (!empty($insert)) {
                    UuidCard::insert($insert);
                    return redirect('/uuid-cards')->with('success', 'UUID Cards from file has imported successed.');

                }

            }

        }


        return back();

    }


}
