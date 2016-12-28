<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Participant;
use App\Models\Stage;
use Illuminate\Http\Request;

class ParticipantStagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $participantId
     * @return \Illuminate\Http\Response
     */
    public function index($participantId)
    {
        $participant = Participant::with(['participantManagers' => function ($query) {
            $query->with('stage', 'uuidCard');
        }])->findOrFail($participantId);

        $stages = Stage::whereDoesntHave('participantManagers', function ($query) use ($participantId){
            $query->where('participant_id', $participantId);
        })->get();
        $categories = Category::all();

        return view('participants.stages.index', compact('participant', 'stages', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $participantId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $participantId)
    {
        $this->validate($request, [
            'category_id' => 'required|integer|exists:categories,id',
            'stage_id' => 'required|integer|exists:stages,id',
        ]);

        $participant = Participant::findOrFail($participantId);

        $manage = $participant->participantManagers()->create([
            'participant_id' => $participant->id,
            'category_id' => $request->input('category_id'),
            'uuid_card_id' => $participant->uuid_card_id,
            'stage_id' => $request->input('stage_id'),
            'post_start' => "00:00:00",
            'post_1'  => "00:00:00",
            'post_2'  => "00:00:00",
            'post_3'  => "00:00:00",
            'post_4'  => "00:00:00",
            'post_5'  => "00:00:00",
            'post_6'  => "00:00:00",
            'post_7'  => "00:00:00",
            'post_8'  => "00:00:00",
            'post_9'  => "00:00:00",
            'post_10'  => "00:00:00",
            'post_11'  => "00:00:00",
            'post_12'  => "00:00:00",
            'post_finish' => "00:00:00",
        ]);

        return redirect(route('participants.stages.index', ['participant' => $participant->id]))
            ->with('success', 'The Stage ' . $manage->stage->name . ' has been added to ' . $participant->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $participantId
     * @param int $participantManageId
     * @return \Illuminate\Http\Response
     */
    public function destroy($participantId, $participantManageId)
    {
        $manage = Stage::where('participant_id', $participantId)->findOrFail($participantManageId);

        $manage->delete();

        return redirect()->route('participants.stages.index')->with('success', $manage->name . ' has been deleted!');
    }
}
