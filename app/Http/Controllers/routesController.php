<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RouteManager;
use App\Models\Stage;
use Illuminate\Http\Request;
use Validator;
use App\Models\Route;


class routesController extends Controller
{

    public function index(){
        $routes = Route::paginate(15);
        return view('routes.index', ['routes' => $routes]);
    }

    public function create(){
        return view('routes.create');
    }

    public function store(Request $request)
    {
        if( $request->ajax() )
        {
            $request->merge(['created_at' => date('Y-m-d H:i:s')]);
            $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
            $rules = [
                'route_name' => 'required|max:255|min:3',
            ];

            $data = $request->only(['route_name', 'created_at', 'updated_at']);
            $validator = Validator::make($data, $rules);

            if($validator->passes())

            {
                $save = Route::create($data);
                $check_count = Route::get()->count();
                return response()->json(['id' => $save->id, 'route_name' => $save->route_name, 'check_count' => $check_count, 'success' => 'The new route has been added.']);


            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }
        }  else {
            return redirect('/routes')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function edit(Request $request, $id)
    {
        if( $request->ajax() )
        {
            $route = Route::findOrFail($id);
            return view('routes.edit', compact('route'));
        }  else {
            return redirect('/routes')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function update(Request $request, $id)
    {
        if( $request->ajax() )
        {
            $route = Route::findOrFail($id);
            $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
            $rules = [
                'route_name' => 'required|max:255|min:2',
            ];
            $data = $request->only(['route_name', 'updated_at']);

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $route->update($data);
                $route_name = $route->route_name;
                return response()->json(['success' => 'Great! The Route has been updated.', 'id' => $route->id, 'route_name' => $route_name]);

            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }
        }  else {
            return redirect('/routes')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function delete($id, Request $request)
    {
        if ( $request->ajax() ) {
            Route::findOrFail($id);
            $count_used_routes = Category::where('routes_id', $id)->get()->count();
            $check_count = Route::get()->count();
            if($count_used_routes === 0) {
                Route::where('id', $id)->delete();
                RouteManager::where('routes_id', $id)->delete();
                return response()->json(['check_count' => $check_count, 'success' => 'Great! The Route has been removed!']);
            } else {
                return response()->json(['check_count' => $check_count, 'warning' => 'Error! This Route is associated!'], 405);
            }
        } else {
            return redirect('/routes')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function check_points($id, Request $request){
        if( $request->ajax() )
        {
            $route_info = Route::where('id', $id)->get()->first();
            $check_points = RouteManager::where('routes_id', $id)->WhereNotIn('post_code', [251,252])->get();
            $count_check_points = $check_points->count();
            $count_number = 1;
            return view('routes.check-points', compact('check_points', 'route_info', 'count_check_points', 'count_number'));

        }  else {
            return redirect('/routes')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

    public function check_points_store($id, Request $request, RouteManager $routeManager){
        if( $request->ajax() )
        {
            $rules = [
                'post_code' => 'required|array|min:1|max:255',
                'post_code.*' => 'required|numeric',
            ];

            $post_code_from_ajax = $request->get('post_code');

            $post_code_array = explode(',', $post_code_from_ajax);
            $request->merge(['post_code' => $post_code_array]);

            $data = $request->only(['post_code']);

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {

                $route_info = Route::where('id', $id)->get()->first();

                // Array from ajax
                $CheckPointsArray = [];

                foreach ($request->input('post_code') as $post)
                {
                    $CheckPointsArray[] = [
                        'routes_id' => $id,
                        'post_code'=> $post,
                        'created_at'=> date('Y-m-d H:i:s'),
                        'updated_at'=> date('Y-m-d H:i:s'),
                    ];
                }


                $routeManager->where('routes_id', $id)->delete();

                $routeManager->createArray($CheckPointsArray);

                 return response()->json(['success' => 'Great! The Check Points for ' .  $route_info->route_name .' has been updated.', 'id' => $route_info->id]);

            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }

        }  else {
            return redirect('/routes')->with(['alert-type' => 'error', 'message' => 'Ilegal operation']);
        }
    }

}
