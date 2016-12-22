<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use DB;
use Session;
use Input;


class routesController extends Controller
{

    public function index(){

        $routes = DB::table('routes')->paginate(15);

        return view('routes', ['routes' => $routes]);


    }




    public function remove($id) {

        DB::table('routes')->where('id', $id)->delete();

        $data = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Route with <strong>ID ' . $id . '</strong> has been removed from database.</div>';
        return redirect('/routes')->with('message', $data);
    }





    public function truncate() {

        DB::table('routes')->truncate();

        return redirect('/routes')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>All Routes has been removed from the database.</div>');
    }


    public function create(Request $request)
    {


        $route_name = $request->input('route_name');
        $route_length = $request->input('route_length');
        $post_nr = $request->input('post_nr');
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


        DB::table('routes')->insertGetId(
            [
                'route_name' => $route_name,
                'route_length' => $route_length,
                'post_nr' => $post_nr,
                'post_1' => $post_1,
                'post_2' => $post_2,
                'post_3' => $post_3,
                'post_4' => $post_4,
                'post_5' => $post_5,
                'post_6' => $post_6,
                'post_7' => $post_7,
                'post_8' => $post_8,
                'post_9' => $post_9,
                'post_10' => $post_10,
                'post_11' => $post_11,
                'post_12' => $post_12
            ]
        );

        return redirect('/routes')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>A new route has been added in the database.</div>');

    }

    public function viewcreate(){

        $stageslist = DB::table('stages')->get();

        return view('routes.create', ['stageslist' => $stageslist]);


    }

    public function edit($id){

        $route = DB::table('routes')
            ->select('id', 'route_name', 'route_length', 'post_nr', 'post_1', 'post_2', 'post_3', 'post_4', 'post_5', 'post_6', 'post_7', 'post_8', 'post_9', 'post_10', 'post_11', 'post_12')
            ->where('id', '=', $id)
            ->first();

        return view('routes.edit', ['route' => $route]);

    }

    public function update(Request $request, $id){


        $route_name = $request->input('route_name');
        $route_length = $request->input('route_length');
        $post_nr = $request->input('post_nr');
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


        DB::table('routes')
            ->where('id', '=', $id)
            ->update([
                'route_name' => $route_name,
                'route_length' => $route_length,
                'post_nr' => $post_nr,
                'post_1' => $post_1,
                'post_2' => $post_2,
                'post_3' => $post_3,
                'post_4' => $post_4,
                'post_5' => $post_5,
                'post_6' => $post_6,
                'post_7' => $post_7,
                'post_8' => $post_8,
                'post_9' => $post_9,
                'post_10' => $post_10,
                'post_11' => $post_11,
                'post_12' => $post_12

            ]);

        $result = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>Route with #ID " . $id .  " have been added updated.</div>";
        return redirect('/routes')->with('message', $result);

    }




}
