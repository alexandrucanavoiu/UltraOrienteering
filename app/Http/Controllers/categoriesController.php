<?php

namespace App\Http\Controllers;

use App\Models\ParticipantStages;
use App\Models\RelayCategory;
use App\Models\RelayCategoryManager;
use App\Models\Setting;
use DB;
use Dompdf\Exception;
use Illuminate\Http\Request;
use Validator;
use App\Models\Category;
use App\Models\Route;


class categoriesController extends Controller
{

    public function index(){

        $setting = Setting::findOrFail(1);
        $competition_type = $setting->competition_type;
        if($competition_type === 1){
            $categories = Category::with('route')->paginate(10);
            return view('categories.index', ['categories' => $categories]);
        } else {
            $categories = RelayCategory::with('CategoryManager')->paginate(10);

            return view('categories.relay_index', ['categories' => $categories]);
        }
    }

    public function create(){
        $setting = Setting::findOrFail(1);
        $competition_type = $setting->competition_type;
        $routes = Route::get();
        if($competition_type === 1){
            return view('categories.create', ['routes' => $routes]);
        } else {
            $count_route = 0;
            return view('categories.relay_create', ['routes' => $routes, 'count_route' => $count_route]);
        }

    }

    public function store(Request $request, RelayCategoryManager $relayCategoryManager)
    {
        if( $request->ajax() )
        {
            $setting = Setting::findOrFail(1);
            $competition_type = $setting->competition_type;


            if($competition_type === 1){
                $request->merge(['created_at' => date('Y-m-d H:i:s')]);
                $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                $rules = [
                    'category_name' => 'required|max:255|min:3',
                    'routes_id' => 'required|numeric|exists:routes,id',
                ];

                $data = $request->only(['category_name', 'routes_id', 'created_at', 'updated_at']);
                $validator = Validator::make($data, $rules);

                if($validator->passes())

                {
                    $save = Category::create($data);
                    $check_count = Category::get()->count();
                    $route = Route::where('id', $save->routes_id)->get()->first();

                    return response()->json(['id' => $save->id, 'category_name' => $save->category_name, 'route_name' => $route->route_name, 'check_count' => $check_count, 'success' => 'The new category has been added.']);

                } else {
                    return response()->json(['error' => $validator->errors()->all()]);
                }
            } else {
                $request->merge(['created_at' => date('Y-m-d H:i:s')]);
                $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                $rules = [
                    'category_name' => 'required|max:255|min:3',
                    'routes_id' => 'required|array|min:1|max:255',
                    'routes_id.*' => 'required|numeric',
                ];

                $routes_id_from_ajax = $request->get('routes_id');
                $routes_id_from_ajax = explode(',', $routes_id_from_ajax);
                $request->merge(['routes_id' => $routes_id_from_ajax]);

                $data = $request->only(['category_name', 'routes_id', 'created_at', 'updated_at']);
                $validator = Validator::make($data, $rules);

                if($validator->passes())

                {

                $category_id = DB::table('relay_categories')->insertGetId(
                    ['category_name' => $data['category_name'], 'created_at' => $data['created_at'], 'updated_at' => $data['updated_at']]
                );

                    // Array from ajax
                    $routesArray = [];
                    $routeName = [];

                    foreach ($request->input('routes_id') as $route)
                    {
                        //array to be inserted
                        $routesArray[] = [
                            'relay_category_id' => $category_id,
                            'routes_id'=> $route,
                            'created_at'=> $data['created_at'],
                            'updated_at'=> $data['updated_at'],
                        ];

                        //get the route name
                        $route = Route::where('id', $route)->get()->first();
                        $routeName[] = $route->route_name;
                    }

                    $routesName = implode(", ", $routeName);
                    $relayCategoryManager->createArray($routesArray);
                    $check_count = RelayCategory::get()->count();

                    return response()->json(['id' => $category_id, 'category_name' => $data['category_name'], 'route_name' => $routesName, 'check_count' => $check_count, 'success' => 'The new category has been added.']);

                } else {
                    return response()->json(['error' => $validator->errors()->all()]);
                }
            }

        }  else {
            return redirect('/categories')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function edit($id, Request $request)
    {
        if( $request->ajax() )
        {

            $setting = Setting::findOrFail(1);
            $competition_type = $setting->competition_type;

            if($competition_type === 1){

                $category = Category::findOrFail($id);
                $routes = Route::get();
                return view('categories.edit', ['category' => $category, 'routes' => $routes]);

            } else {
                $category = RelayCategory::findOrFail($id);
                $relayCategorymanager = RelayCategoryManager::with('route')->where('relay_category_id', $id)->get();

                $collection = collect([0]);
                foreach ($relayCategorymanager as $cat){
                    $collection->push($cat->routes_id);
                }
                $searchroutes = $collection->all();
                $searchroutes = collect($searchroutes);

                $routes = Route::get();
                return view('categories.relay_edit', ['category' => $category, 'routes' => $routes, 'relayCategorymanager' => $relayCategorymanager, 'searchroutes' => $searchroutes]);

            }
        }  else {
            return redirect('/categories')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }


    public function update(Request $request, $id, RelayCategoryManager $relayCategoryManager)
    {
        if( $request->ajax() )
        {

            $setting = Setting::findOrFail(1);
            $competition_type = $setting->competition_type;

            if($competition_type === 1){
                $category = Category::findOrFail($id);
                $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                $rules = [
                    'category_name' => 'required|max:255|min:3',
                    'routes_id' => 'required|numeric|exists:routes,id',
                ];

                $data = $request->only(['category_name', 'routes_id', 'updated_at']);

                $validator = Validator::make($data, $rules);

                if ($validator->passes()) {
                    $category->update($data);
                    $route_name = $category->route->route_name;
                    $category_name = $category->category_name;
                    return response()->json(['success' => 'Great! The Category has been updated.', 'id' => $category->id, 'route_name' => $route_name, 'category_name' => $category_name]);

                } else {
                    return response()->json(['error' => $validator->errors()->all()]);
                }
            } else {
                $category = RelayCategory::findOrFail($id);
                $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                $rules = [
                    'category_name' => 'required|max:255|min:3',
                    'routes_id' => 'required|array|min:1|max:255',
                    'routes_id.*' => 'required|numeric',
                ];

                $routes_id_from_ajax = $request->get('routes_id');
                $routes_id_from_ajax = explode(',', $routes_id_from_ajax);
                $request->merge(['routes_id' => $routes_id_from_ajax]);

                $data = $request->only(['category_name', 'routes_id', 'updated_at']);

                $validator = Validator::make($data, $rules);

                if ($validator->passes()) {

                    $category->update($data);

                    // Array from ajax
                    $routesArray = [];
                    $routeName = [];

                    foreach ($request->input('routes_id') as $route)
                    {
                        //array to be inserted
                        $routesArray[] = [
                            'relay_category_id' => $category->id,
                            'routes_id'=> $route,
                            'created_at'=> $data['updated_at'],
                            'updated_at'=> $data['updated_at'],
                        ];

                        //get the route name
                        $route = Route::where('id', $route)->get()->first();
                        $routeName[] = $route->route_name;
                    }

                    RelayCategoryManager::where('relay_category_id', $id)->delete();

                    $routesName = implode(", ", $routeName);
                    $relayCategoryManager->createArray($routesArray);

                    return response()->json(['success' => 'Great! The Category has been updated.', 'id' => $category->id, 'route_name' => $routesName, 'category_name' => $category->category_name]);

                } else {
                    return response()->json(['error' => $validator->errors()->all()]);
                }
            }

        }  else {
            return redirect('/categories')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function delete($id, Request $request)
    {
        if ( $request->ajax() ) {

            $setting = Setting::findOrFail(1);
            $competition_type = $setting->competition_type;


            if($competition_type === 1){

                Category::findOrFail($id);
                $count_used_categories = ParticipantStages::where('categories_id', $id)->get()->count();
                $check_count = Category::get()->count();
                if($count_used_categories === 0){
                    Category::where('id', $id)->delete();
                    return response()->json(['check_count' => $check_count, 'success' => 'Great! The Category has been removed!']);
                } else {
                    return response()->json(['check_count' => $check_count, 'warning' => 'Error! This Category is associated!'], 405);
                }
            } else {
                RelayCategory::findOrFail($id);
                $count_used_categories = ParticipantStages::where('categories_id', $id)->get()->count();
                $check_count = RelayCategory::get()->count();
                if($count_used_categories === 0){
                    RelayCategory::where('id', $id)->delete();
                    RelayCategoryManager::where('relay_category_id', $id)->delete();
                    return response()->json(['check_count' => $check_count, 'success' => 'Great! The Category has been removed!']);
                } else {
                    return response()->json(['check_count' => $check_count, 'warning' => 'Error! This Category is associated!'], 405);
                }
            }


        } else {
            return redirect('/participants')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }


}
