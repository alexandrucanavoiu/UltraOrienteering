<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Participant;
use App\Models\ParticipantManager;
use App\Models\Stage;
use App\Models\UuidCard;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Route;

class dashboardController extends Controller
{

    public function dashboard() {

        $clubs = Club::All()->count();
        $participants = Participant::All()->count();
        $stages = Stage::All()->count();
        $categories = Category::All()->count();
        $routelist = Route::paginate(15);
        $participantmanager = ParticipantManager::All()->count();
        $uuidcard = UuidCard::All()->count();


        return view('dashboard', ['participantmanager' => $participantmanager, 'uuidcard' => $uuidcard, 'clubs' => $clubs, 'participants' => $participants, 'categories' => $categories, 'stages' => $stages, 'routelist' => $routelist]);
    }

}
