<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use DB;
use Session;
use Input;
use App\Models\Category;
use App\Models\Route;


class categoriesController extends Controller
{

    public function index(){

        $categories = Category::with('route')->paginate(15);
        $routes = Route::All();

        return view('categories', ['categories' => $categories, 'routes' => $routes]);

    }



    public function remove($id) {

        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/categories')->with('success', $category->name . ' has been removed from database.');
    }


    public function create(Request $request)
    {

        $this->validate($request, [
            'category' => 'required|max:255|min:2|unique:categories,name',
            'route_name' => 'required|integer',
        ]);

        $category = Category::create([
            'name' => $request->input('category'),
            'route_id' => $request->input('route_name')
        ]);
        return redirect('/categories')->with('success', $category->name . ' category has been added in the database.');

    }

    public function edit($id){

        $category = Category::with('route')->findOrFail($id);
        $routes = Route::All();


        return view('categories.edit', ['category' => $category, 'routes' => $routes]);


    }


    public function update(Request $request, $id){


        $category = Category::findOrFail($id);

        $this->validate($request, [
            'category_name' => 'required|max:255|min:2|unique:categories,name',
            'route_name' => 'required|integer'
        ]);

        $category->update([
            'name' => $request->input('category_name'),
            'route_id' => $request->input('route_name')
        ]);


        return redirect('/categories')->with('success', $category->name . ' have been added updated.');

    }



}
