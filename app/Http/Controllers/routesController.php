<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use DB;
use Session;
use Input;
use App\Models\Route;


class routesController extends Controller
{

    public function index(){

        $routes = Route::paginate(15);

        return view('routes', ['routes' => $routes]);


    }


    public function viewcreate(){

        return view('routes.create');

    }

    public function create(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:2',
            'length_in_km' => 'required',
            'post_amount' => 'required|integer',
            'post_1' => 'required',
        ]);


        $route = Route::create([
            'name' => $request->input('name'),
            'length_in_km' => $request->input('length_in_km'),
            'post_amount' => $request->input('post_amount'),
            'post_1' => $request->input('post_1'),
            'post_2' => $request->input('post_2'),
            'post_3' => $request->input('post_3'),
            'post_4' => $request->input('post_4'),
            'post_5' => $request->input('post_5'),
            'post_6' => $request->input('post_6'),
            'post_7' => $request->input('post_7'),
            'post_8' => $request->input('post_8'),
            'post_9' => $request->input('post_9'),
            'post_10' => $request->input('post_10'),
            'post_11' => $request->input('post_11'),
            'post_12' => $request->input('post_12')
        ]);

        return redirect('/routes')->with('success', 'Route' . $route->name . ' has been added in the database.');

    }


    public function remove($id) {
        $route = Route::find($id);

        if (!$route) {  return redirect('/routes')->with('error', 'You cannot remove the route with id ' . $id . ' becouse not exist! '); }

        $route->delete();

        return redirect('/routes')->with('success', $route->name . ' has been removed from database.');
    }



    public function edit($id){

        $route = Route::find($id);

        if (!$route) {  return redirect('/routes')->with('error', 'You cannot edit the route with id ' . $id . ' becouse not exist! '); }

        return view('routes.edit', ['route' => $route]);

    }

    public function update(Request $request, $id){

        $route = Route::find($id);

        if (!$route) {  return redirect('/routes')->with('error', 'You cannot update the route with id ' . $id . ' becouse not exist! '); }

        $this->validate($request, [
            'name' => 'required',
        ]);

        $route->update([
            'name' => $request->input('name'),
            'length_in_km' => $request->input('length_in_km'),
            'post_amount' => $request->input('post_amount'),
            'post_1' => $request->input('post_1'),
            'post_2' => $request->input('post_2'),
            'post_3' => $request->input('post_3'),
            'post_4' => $request->input('post_4'),
            'post_5' => $request->input('post_5'),
            'post_6' => $request->input('post_6'),
            'post_7' => $request->input('post_7'),
            'post_8' => $request->input('post_8'),
            'post_9' => $request->input('post_9'),
            'post_10' => $request->input('post_10'),
            'post_11' => $request->input('post_11'),
            'post_12' => $request->input('post_12'),
        ]);

        return redirect('/routes')->with('success', $route->name . ' have been added updated.');

    }




}
