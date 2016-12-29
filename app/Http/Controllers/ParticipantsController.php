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

class ParticipantsController extends Controller
{
    /**
     * Serve page to see all the Participants in the system
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $participants = Participant::with('uuidCard', 'club')->paginate(100);

        return view('participants.index', compact('participants'));
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
        $participant->delete();



        return redirect()->route('participants.index')->with('success', $name . ' has been deleted!');
    }
}

