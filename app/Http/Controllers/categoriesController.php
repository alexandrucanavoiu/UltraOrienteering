<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use DB;
use Session;
use Input;


class categoriesController extends Controller
{

    public function index(){

        $categories = DB::table('categories')
            ->select(
                'categories.id as categories_id',
                'categories.category_name',
                'categories.route_name as categories_route_name',
                'routes.route_name as routes_route_name'
            )
            ->leftJoin('routes', 'routes.id', '=', 'categories.route_name')
            ->paginate(15);

        $routes = DB::table('routes')->get();


        return view('categories', ['categories' => $categories, 'routes' => $routes]);


    }




    public function remove($id) {

        DB::table('categories')->where('id', $id)->delete();

        $data = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Category with <strong>ID ' . $id . '</strong> has been removed from database.</div>';
        return redirect('/categories')->with('message', $data);
    }





    public function truncate() {

        DB::table('categories')->truncate();

        return redirect('/categories')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>All Categories has been removed from the database.</div>');
    }


    public function create(Request $request)
    {

        $category = $request->input('category');
        $route_name = $request->input('route_name');

        $this->validate($request, [
            'category' => 'required|max:255|min:2|unique:categories,category_name',
        ]);


        DB::table('categories')->insertGetId(
            [
                'category_name' => $category,
                'route_name' => $route_name
            ]
        );

        return redirect('/categories')->with('message', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>A new category has been added in the database.</div>');

    }

    public function edit($id){

        $category = DB::table('categories')
            ->select(
                'categories.id as categories_id',
                'categories.category_name',
                'categories.route_name as categories_route_name'
            )
            ->leftJoin('routes', 'routes.id', '=', 'categories.route_name')
            ->where('categories.id', '=', $id)
            ->first();

        $routes = DB::table('routes')->get();


        return view('categories.edit', ['category' => $category, 'routes' => $routes]);


    }


    public function update(Request $request, $id){


        $category_name = $request->input('category_name');
        $route_name = $request->input('route_name');


        DB::table('categories')
            ->where('id', '=', $id)
            ->update(['category_name' => $category_name, 'route_name' => $route_name]);

        $result = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>Category with #ID " . $id .  " have been added updated.</div>";
        return redirect('/categories')->with('message', $result);

    }



}
