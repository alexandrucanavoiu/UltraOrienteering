<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Club;
use App\Models\Participant;
use App\Models\UuidCard;
use Illuminate\Http\Request;
use DB;

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


    public function edit($id){
        $participants = DB::table('participants')
            ->select(
                'participants.id as participant_id',
                'participants.uuidcard_id as participant_uuidcard_id',
                'participants.clubs_name as participant_club_name',
                'participants.participants_name as participant_name',
                'uuidcards.id as uuidcards_id',
                'uuidcards.uuidcard as uuidcards_uuidcard_name',
                'clubs.id as clubs_id',
                'clubs.club_name as club_name'
            )
            ->leftJoin('uuidcards', 'uuidcards.id', '=', 'participants.uuidcard_id')
            ->leftJoin('clubs', 'clubs.id', '=', 'participants.clubs_name')
            ->where('participants.id', '=', $id)
            ->first();

        $clubs = DB::table('clubs')->get();
        $category = DB::table('categories')->get();
        $uuidlist = DB::table('uuidcards')->get();

        return view('participants.edit', ['category' => $category, 'participants' => $participants, 'uuidlist' => $uuidlist, 'clubs' => $clubs]);

    }

    public function update(Request $request, $id){


        $participants_name = $request->input('participants_name');
        $uuidcard_id = $request->input('uuidcard_id');
        $clubs_id = $request->input('clubs_id');


        DB::table('participants')
            ->where('participants.id', '=', $id)
            ->update(['participants_name' => $participants_name, 'uuidcard_id' => $uuidcard_id, 'clubs_name' => $clubs_id]);

        $result = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>The participant with #ID " . $id .  " have been added updated.</div>";
        return redirect('/participants')->with('message', $result);

    }

    public function manage($id){
        $participant = Participant::with(['uuidCard', 'participantManagers' => function ($query) {
            $query->with('stage', 'category.route', 'uuidCard');
        }])->findOrFail($id);

        $categories = Category::all();

        return view('participants.manage', compact('participant', 'categories'));
    }

    public function manageupdate(Request $request)
    {
        $participant_id = $request->input('participant_id');
        $uuidcards_id = $request->input('uuidcards_id');
        $stage_name = $request->input('stage_name');
        $participant_category = $request->input('participant_category');
        $post_s = $request->input('post_s');
        $post_1 = $request->input('post_1');
        $post_2 = $request->input('post_2');
        $post_3 = $request->input('post_3');
        $post_4 = $request->input('post_4');
        $post_5 = $request->input('post_5');
        $post_6 = $request->input('post_6');
        $post_7 = $request->input('post_7');
        $post_8 = $request->input('post_8');
        $post_9 = $request->input('post_9');
        $post_10 = $request->input('post_10');
        $post_11 = $request->input('post_11');
        $post_12 = $request->input('post_12');
        $post_f = $request->input('post_f');

        $check_id = $participant_id[0];

        $check = DB::table('participants_manage')
            ->where('participants_id', '=', $check_id)
            ->where('stages_name', '=', $stage_name)
            ->first();


        if($check !== null)
        {
            foreach ($participant_id as $value => $value2)
            {
                $pu = $participant_id[$value];
                $xu = $uuidcards_id[$value];
                $xs = $stage_name[$value];
                $xc = $participant_category[$value];
//                $ps = $post_s[$value];
//                $p1 = $post_1[$value];
//                $p2 = $post_2[$value];
//                $p3 = $post_3[$value];
//                $p4 = $post_4[$value];
//                $p5 = $post_5[$value];
//                $p6 = $post_6[$value];
//                $p7 = $post_7[$value];
//                $p8 = $post_8[$value];
//                $p9 = $post_9[$value];
//                $p10 = $post_10[$value];
//                $p11 = $post_11[$value];
//                $p12 = $post_12[$value];
//                $pf = $post_f[$value];



                DB::table('participants_manage')
                    ->where('participants_id', '=', $check_id)
                    ->where('stages_name', '=', $xs)->update(
                        [
                             'categories_id' => $xc
//                            'post_s' => $ps,
//                            'post_1' => $p1,
//                            'post_2' => $p2,
//                            'post_3' => $p3,
//                            'post_4' => $p4,
//                            'post_5' => $p5,
//                            'post_6' => $p6,
//                            'post_7' => $p7,
//                            'post_8' => $p8,
//                            'post_9' => $p9,
//                            'post_10' => $p10,
//                            'post_11' => $p11,
//                            'post_12' => $p12,
//                            'post_f' => $pf

                        ]
                    );
            }


        } else {

            foreach ($participant_id as $value => $value2) {
                $pu = $participant_id[$value];
                $xu = $uuidcards_id[$value];
                $xs = $stage_name[$value];
                $xc = $participant_category[$value];
//                $ps = $post_s[$value];
//                $p1 = $post_1[$value];
//                $p2 = $post_2[$value];
//                $p3 = $post_3[$value];
//                $p4 = $post_4[$value];
//                $p5 = $post_5[$value];
//                $p6 = $post_6[$value];
//                $p7 = $post_7[$value];
//                $p8 = $post_8[$value];
//                $p9 = $post_9[$value];
//                $p10 = $post_10[$value];
//                $p11 = $post_11[$value];
//                $p12 = $post_12[$value];
//                $pf = $post_f[$value];


                DB::table('participants_manage')->insertGetId(
                    [
                        'participants_id' => $pu,
                        'uuidcards_id' => $xu,
                        'stages_name' => $xs,
                        'categories_id' => $xc
//                            'post_s' => $ps,
//                            'post_1' => $p1,
//                            'post_2' => $p2,
//                            'post_3' => $p3,
//                            'post_4' => $p4,
//                            'post_5' => $p5,
//                            'post_6' => $p6,
//                            'post_7' => $p7,
//                            'post_8' => $p8,
//                            'post_9' => $p9,
//                            'post_10' => $p10,
//                            'post_11' => $p11,
//                            'post_12' => $p12,
//                            'post_f' => $pf
                    ]
                );
            }

        }

        return redirect(route('post.manageupdate', array('id' => $check_id)))->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>All records has been added in the database.</div>');

    }


    public function remove($id) {

        DB::table('participants')->where('id', $id)->delete();

        $data = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> The participant with <strong>ID ' . $id . '</strong> has been removed from the database.</div>';
        return redirect('/participants')->with('message', $data);
    }


    public function truncate() {

        DB::table('participants')->truncate();

        return redirect('/participants')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>All participants has been removed from the database.</div>');
    }







}

