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

class rankingsController extends Controller
{
    public function index()
    {
        $stages = Stage::All();

        $number = 1;

        return view('rankings.index', compact('stages', 'number'));
     }

    public function category($id)
    {

        $stage = Stage::findOrFail($id);
        $category = Category::All();

        return view('rankings.category', compact('category', 'stage'));
    }

    public function rankinglist($id_stage, $id_category)
    {

        $stage = Stage::findOrFail($id_stage);
        $category = Category::findOrFail($id_category);

        $participant = ParticipantManager::where('category_id', '=', $id_category)->where('stage_id', '=', $id_stage)->orderBy('total_time', 'asc')->get();

        $number = 1;

        return view('rankings.rankinglist', compact('participant', 'stage', 'category', 'number'));
    }



}

