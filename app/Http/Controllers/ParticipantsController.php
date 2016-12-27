<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Club;
use App\Models\Participant;
use App\Models\ParticipantManager;
use App\Models\UuidCard;
use Illuminate\Http\Request;
use DB;
use Illuminate\Validation\Rule;

class ParticipantsController extends Controller
{
    public function index()
    {
        $participants = Participant::with('uuidCard', 'club')->paginate(100);

        return view('participants.index', compact('participants'));
    }

    public function create()
    {
        $uuidList = UuidCard::all();
        $clubs = Club::all();

        return view('participants.create', compact('uuidList', 'clubs'));
    }

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

        return redirect('/participants')->with('success', $participant->name . ' has been stored!');
    }

    public function edit($id)
    {
        $participant = Participant::with('uuidCard', 'club')->findOrFail($id);

        $clubs = Club::all();
        $uuidList = UuidCard::all();

        return view('participants.edit', compact('participant', 'clubs', 'uuidList'));
    }

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

        return redirect('/participants')->with('success', $participant->name . ' has been updated!');

    }

    public function manage($id)
    {
        $participant = Participant::with(['participantManagers' => function ($query) {
            $query->with('stage', 'uuidCard');
        }])->findOrFail($id);

        $categories = Category::all();

        return view('participants.manage', compact('participant', 'categories'));
    }

    public function updateManage(Request $request, $id)
    {
        $this->validate($request, [
            'manage.*' => [
                'required',
//                Rule::exists('participant_managers', 'id')->where('participant_id', $id), // broken
            ],
            'manage.*.category_id' => 'required|exists:categories,id',
            'manage.*.post_start' => 'required|date_format:H:i:s',
            'manage.*.post_1' => 'required|date_format:H:i:s',
            'manage.*.post_2' => 'required|date_format:H:i:s',
            'manage.*.post_3' => 'required|date_format:H:i:s',
            'manage.*.post_4' => 'required|date_format:H:i:s',
            'manage.*.post_5' => 'required|date_format:H:i:s',
            'manage.*.post_6' => 'required|date_format:H:i:s',
            'manage.*.post_7' => 'required|date_format:H:i:s',
            'manage.*.post_8' => 'required|date_format:H:i:s',
            'manage.*.post_9' => 'required|date_format:H:i:s',
            'manage.*.post_10' => 'required|date_format:H:i:s',
            'manage.*.post_11' => 'required|date_format:H:i:s',
            'manage.*.post_12' => 'required|date_format:H:i:s',
            'manage.*.post_finish' => 'required|date_format:H:i:s',
        ]);

        $participant = Participant::findOrFail($id);

        foreach ($request->input('manage') as $manageId => $manage) {
            $manager = $participant->participantManagers()->findOrFail($manageId);

            $manager->update([
                'category_id' => $manage['category_id'],
                'post_start' => $manage['post_start'],
                'post_1' => $manage['post_1'],
                'post_2' => $manage['post_2'],
                'post_3' => $manage['post_3'],
                'post_4' => $manage['post_4'],
                'post_5' => $manage['post_5'],
                'post_6' => $manage['post_6'],
                'post_7' => $manage['post_7'],
                'post_8' => $manage['post_8'],
                'post_9' => $manage['post_9'],
                'post_10' => $manage['post_10'],
                'post_11' => $manage['post_11'],
                'post_12' => $manage['post_12'],
                'post_finish' => $manage['post_finish'],
            ]);
        }

        return redirect(route('participants.index'))->with('success', 'Successfully stored the achievements for ' . $participant->name . '!');
    }


    public function destroy($id)
    {
        $participant = Participant::findOrFail($id);
        $participant->delete();

        return redirect('/participants')->with('message', $participant->name . ' has been deleted!');
    }


    public function truncate() {

        DB::table('participants')->truncate();

        return redirect('/participants')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>All participants has been removed from the database.</div>');
    }







}

