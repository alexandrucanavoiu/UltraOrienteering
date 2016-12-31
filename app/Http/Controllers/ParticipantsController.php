<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Club;
use App\Models\Participant;
use App\Models\UuidCard;
use App\Models\Stage;
use App\Models\ParticipantManager;
use Illuminate\Http\Request;
use DB;
use Illuminate\Validation\Rule;
use Excel;
use PDF;
use Input;

class ParticipantsController extends Controller
{
    /**
     * Serve page to see all the Participants in the system
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $participants = Participant::with('uuidCard', 'club')
            ->select('clubs.name as club_name', 'participants.*')
            ->join('clubs', 'participants.club_id', '=', 'clubs.id')
            ->orderBy('clubs.name', 'ASC')
            ->paginate(100);

        $stages = Stage::All();
        $categories = Category::All();

        return view('participants.index', compact('participants', 'stages', 'categories'));
    }

    /**
     * Serve page to create a Participant
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $uuidList = UuidCard::all();
        $clubs = Club::all();

        return view('participants.create', compact('uuidList', 'clubs'));
    }

    /**
     * Store the participant in the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'club_id' => 'required|integer|exists:clubs,id',
            'uuid_card_id' => 'required|integer|exists:uuid_cards,id',
            'name' => 'required',
        ]);

        $participant = Participant::create([
            'club_id' => $request->input('club_id'),
            'uuid_card_id' => $request->input('uuid_card_id'),
            'name' => $request->input('name'),
        ]);

        return redirect()->route('participants.index')->with('success', $participant->name . ' has been stored!');
    }

    /**
     * Serve page to edit a Participant
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $participant = Participant::with('uuidCard', 'club')->findOrFail($id);

        $clubs = Club::all();
        $uuidList = UuidCard::all();

        return view('participants.edit', compact('participant', 'clubs', 'uuidList'));
    }

    /**
     * Update a participant with new data
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'club_id' => 'required|integer|exists:clubs,id',
            'uuid_card_id' => 'required|integer|exists:uuid_cards,id',
            'name' => 'required',
        ]);

        $participant = Participant::findOrFail($id);

        $participant->update([
            'club_id' => $request->input('club_id'),
            'uuid_card_id' => $request->input('uuid_card_id'),
            'name' => $request->input('name'),
        ]);

        return redirect()->route('participants.index')->with('success', $participant->name . ' has been updated!');
    }

    /**
     * Serve page to manage a Participant
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manage($id)
    {
        $participant = Participant::with(['participantManagers' => function ($query) {
            $query->with('stage', 'uuidCard');
        }])->findOrFail($id);

        $categories = Category::all();

        return view('participants.manage', compact('participant', 'categories'));
    }

    /**
     * Update the Participant manage
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateManage(Request $request, $id)
    {
        $this->validate($request, [
            'manage' => 'required|array',
            'manage.*' => 'required|array',
            'manage.*.category_id' => 'required|exists:categories,id',
            'manage.*.total_time' => 'required|date_format:H:i:s',
//            'manage.*.post_start' => 'required|date_format:H:i:s',
//            'manage.*.post_1' => 'required|date_format:H:i:s',
//            'manage.*.post_2' => 'required|date_format:H:i:s',
//            'manage.*.post_3' => 'required|date_format:H:i:s',
//            'manage.*.post_4' => 'required|date_format:H:i:s',
//            'manage.*.post_5' => 'required|date_format:H:i:s',
//            'manage.*.post_6' => 'required|date_format:H:i:s',
//            'manage.*.post_7' => 'required|date_format:H:i:s',
//            'manage.*.post_8' => 'required|date_format:H:i:s',
//            'manage.*.post_9' => 'required|date_format:H:i:s',
//            'manage.*.post_10' => 'required|date_format:H:i:s',
//            'manage.*.post_11' => 'required|date_format:H:i:s',
//            'manage.*.post_12' => 'required|date_format:H:i:s',
//            'manage.*.post_finish' => 'required|date_format:H:i:s',
        ]);

        $participant = Participant::findOrFail($id);

        foreach ($request->input('manage') as $manageId => $manage) {
            $manager = $participant->participantManagers()->findOrFail($manageId);

            $manager->update([
                'category_id' => $manage['category_id'],
                'total_time' => $manage['total_time'],
//                'post_start' => $manage['post_start'],
//                'post_1' => $manage['post_1'],
//                'post_2' => $manage['post_2'],
//                'post_3' => $manage['post_3'],
//                'post_4' => $manage['post_4'],
//                'post_5' => $manage['post_5'],
//                'post_6' => $manage['post_6'],
//                'post_7' => $manage['post_7'],
//                'post_8' => $manage['post_8'],
//                'post_9' => $manage['post_9'],
//                'post_10' => $manage['post_10'],
//                'post_11' => $manage['post_11'],
//                'post_12' => $manage['post_12'],
//                'post_finish' => $manage['post_finish'],
            ]);
        }

        return redirect()->route('participants.index')->with('success', 'Successfully stored the achievements for ' . $participant->name . '!');
    }

    /**
     * Delete the Participant
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $participant = Participant::findOrFail($id);
        $name = $participant->name;
        try {
            $participant->delete();
        } catch(\Exception $e) {
            if (stristr($e->getMessage(), 'Cannot delete or update a parent row')) {
                return redirect('/participants')->with('warning', $name . '  cannot be deleted because it has related entities. Please first remove all the other dates that uses this record...');
            }
        }


        return redirect()->route('participants.index')->with('success', $name . ' has been deleted!');
    }

    /**
     * Filter the Participant by Stage and Category
     */
    public function filter(Request $request)
    {
        $this->validate($request, [
            'stage_name_filter' => 'required|integer|exists:stages,id',
            'category_name_filter' => 'required|integer|exists:categories,id',
        ]);

        $stages = Stage::All();
        $categories = Category::All();

        $id_stage = $request->input('stage_name_filter');
        $id_category = $request->input('category_name_filter');

        $stage = Stage::findOrFail($id_stage);
        $category = Category::findOrFail($id_category);
        $number = 1;

        $participants = ParticipantManager::where('category_id', '=', $id_category)->where('stage_id', '=', $id_stage)->get();

        return view('participants.filter', compact('participants', 'stage', 'category', 'number', 'stages', 'categories', 'id_category', 'id_stage'));

    }

    /**
     * After Filter the Participant by Stage and Category export to PDF
     */
    public function filterexportxls($id_stage, $id_category)
    {
        $stage = Stage::findOrFail($id_stage);
        $category = Category::findOrFail($id_category);

        $participants = ParticipantManager::where('category_id', '=', $id_category)->where('stage_id', '=', $id_stage)->get();

        $number = 1;

        $pdf=PDF::loadView('participants.pdf.participants', ['participants'=>$participants,'stage'=>$stage, 'category'=>$category, 'number'=>$number ]);
        return $pdf->stream('participants'. $id_stage .'_category'.$id_category.'.pdf');

    }

    /**
     * Import time for Participant using UUID CARDS system
     */
    public function importuuidcards()
    {
        $stages = Stage::all();

        return view('participants.importuuidcards', compact('stages'));
    }

    /**
     * Import time for Participant using UUID CARDS system
     */
    public function importuuidcardsxls(Request $request)
    {

        $stages = $request->input('stages');

        $this->validate($request, [

            'import_file' => 'required'

        ]);

        $uuidlist = UuidCard::All();

        if (Input::hasFile('import_file')) {

            $path = Input::file('import_file')->getRealPath();

            $data = Excel::load($path, function ($reader) {

            })->get();

            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {

                    if($value->total_time == "ERROR !!") {
                        $value->total_time = "2016-12-31 23:59:59.000000";
                    }
                    $insert[] = ['uuid_card_id' => $value->uuid_card_id, 'total_time' => $value->total_time];
                }

                if (!empty($insert)) {


                    foreach ($insert as $data) {

                        foreach ($uuidlist as $uuid) {

                            if($data['uuid_card_id'] === $uuid->uuidcard) {

                                DB::table('participant_managers')
                                    ->where('uuid_card_id', $uuid->id)
                                    ->where('stage_id', $stages)
                                    ->update(['total_time' => $data['total_time']]);

                            }

                        }
                    }

                    return redirect('/participants/import')->with('success', 'UUID Cards from file has imported successed.');

                }
            }
        }
        return back();
    }

}

