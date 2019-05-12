<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/',['as'=>'dashboard','uses'=> 'dashboardController@dashboard']);

Route::get('/settings',['as'=>'settings','uses'=> 'settingsController@index']);
Route::get('/settings/edit',['as'=>'settings','uses'=> 'settingsController@edit']);
Route::post('/settings/update',['as'=>'settings','uses'=> 'settingsController@update']);

Route::get('/uuid-cards',['as'=>'uuid-cards','uses'=> 'uuidcardsController@index']);
Route::get('/uuid-cards/all',['as'=>'uuid-cards.all','uses'=> 'uuidcardsController@index_anyData_all']);
Route::get('/uuid-cards/{id}/edit',['as'=>'uuid-cards.edit','uses'=> 'uuidcardsController@edit']);
Route::post('/uuid-cards/{id}/update',['as'=>'uuid-cards.update','uses'=> 'uuidcardsController@update']);
Route::get('/uuid-cards/{id}/delete',['as'=>'uuid-cards.delete','uses'=> 'uuidcardsController@delete']);
Route::get('/uuid-cards/downloadExcel/{type}',['as'=>'uuid-cards.download','uses'=> 'uuidcardsController@downloadExcel']);
Route::post('/uuid-cards/importExcel', 'uuidcardsController@importExcel');
Route::get('/uuid-cards/clean-all',['as'=>'uuid-cards.drop','uses'=> 'uuidcardsController@clean']);

Route::get('/clubs',['as'=>'clubs','uses'=> 'clubsController@index']);
Route::get('/clubs/all',['as'=>'clubs.all','uses'=> 'clubsController@index_anyData_all']);
Route::get('/clubs/{id}/edit', 'clubsController@edit');
Route::post('/clubs/{id}/update', 'clubsController@update');
Route::get('/clubs/{id}/delete', 'clubsController@delete');
Route::get('/clubs/create', 'clubsController@create');
Route::post('/clubs/create',['as'=>'clubs.store','uses'=> 'clubsController@store']);

Route::get('/participants',['as'=>'participants','uses'=> 'ParticipantsController@index']);
Route::get('/participants/all',['as'=>'participants.all','uses'=> 'ParticipantsController@index_anyData_all']);
Route::get('/participants/create',['as'=>'participants.create','uses'=> 'ParticipantsController@create']);
Route::post('/participants/create',['as'=>'participants.store','uses'=> 'ParticipantsController@store']);
Route::get('/participants/{id}/edit',['as'=>'participants.edit','uses'=> 'ParticipantsController@edit']);
Route::post('/participants/{id}/update',['as'=>'participants.update','uses'=> 'ParticipantsController@update']);
Route::get('/participants/{id}/delete',['as'=>'participants.delete','uses'=> 'ParticipantsController@delete']);

Route::get('/participants/{id}/stages',['as'=>'participants.stages','uses'=> 'ParticipantStagesController@index']);
Route::get('/participants/{id}/stages/create',['as'=>'participants.stages.create','uses'=> 'ParticipantStagesController@create']);
Route::post('/participants/{id}/stages/create',['as'=>'participants.stages.store','uses'=> 'ParticipantStagesController@store']);
Route::get('/participants/{participantID}/stages/{stagesID}/edit',['as'=>'participants.stages.edit','uses'=> 'ParticipantStagesController@edit']);
Route::post('/participants/{participantID}/stages/{stagesID}/update',['as'=>'participants.stages.update','uses'=> 'ParticipantStagesController@update']);
Route::post('/participants/{participantID}/stages/{stagesID}/delete',['as'=>'participants.stages.delete','uses'=> 'ParticipantStagesController@delete']);
Route::post('/participants/{participantID}/stages/category/{CategoryID}',['as'=>'participants.stages.category.route','uses'=> 'ParticipantStagesController@category_route_select']);
Route::get('/participants/relay-stages/{id}/edit',['as'=>'participants.stages.relay.stages.management','uses'=> 'ParticipantStagesController@relay_stages_management']);
Route::post('/participants/relay-stages/{id}/edit',['as'=>'participants.stages.relay.stages.management','uses'=> 'ParticipantStagesController@relay_stages_management_update']);

Route::get('/stages',['as'=>'stages','uses'=> 'stagesController@index']);
Route::get('/stages/create',['as'=>'stages.create','uses'=> 'stagesController@create']);
Route::post('/stages/create',['as'=>'stages.store','uses'=> 'stagesController@store']);
Route::get('/stages/{id}/edit',['as'=>'stages.edit','uses'=> 'stagesController@edit']);
Route::post('/stages/{id}/update',['as'=>'stages.update','uses'=> 'stagesController@update']);
Route::get('/stages/{id}/delete',['as'=>'stages.delete','uses'=> 'stagesController@delete']);

Route::get('/routes',['as'=>'routes','uses'=> 'routesController@index']);
Route::get('/routes/create',['as'=>'routes.create','uses'=> 'routesController@create']);
Route::post('/routes/create',['as'=>'routes.store','uses'=> 'routesController@store']);
Route::get('/routes/{id}/edit',['as'=>'routes.edit','uses'=> 'routesController@edit']);
Route::post('/routes/{id}/update',['as'=>'routes.update','uses'=> 'routesController@update']);
Route::get('/routes/{id}/delete',['as'=>'routes.delete','uses'=> 'routesController@delete']);
Route::get('/routes/{id}/check-points',['as'=>'routes.check-points','uses'=> 'routesController@check_points']);
Route::post('/routes/{id}/check-points',['as'=>'routes.check-points-store','uses'=> 'routesController@check_points_store']);

Route::get('/categories',['as'=>'categories','uses'=> 'categoriesController@index']);
Route::get('/categories/create',['as'=>'categories.create','uses'=> 'categoriesController@create']);
Route::post('/categories/create',['as'=>'categories.store','uses'=> 'categoriesController@store']);
Route::get('/categories/{id}/edit',['as'=>'categories.edit','uses'=> 'categoriesController@edit']);
Route::post('/categories/{id}/update',['as'=>'categories.update','uses'=> 'categoriesController@update']);
Route::get('/categories/{id}/delete',['as'=>'categories.delete','uses'=> 'categoriesController@delete']);

Route::get('/import-log',['as'=>'import-log','uses'=> 'ParticipantsController@import_log']);
Route::post('/import-log',['as'=>'import-log.import','uses'=> 'ParticipantsController@import_log_import']);

Route::get('/rankings',['as'=>'rankings','uses'=> 'rankingsController@index']);
Route::get('/rankings/{id_stage}/view',['as'=>'rankings.categories','uses'=> 'rankingsController@categories']);
Route::get('/rankings/{id_stage}/view/{id_category}/ranking',['as'=>'rankings.categories.ranks','uses'=> 'rankingsController@ranking_category']);
Route::get('/rankings/{id_stage}/view/{id_category}/ranking/pdf', 'rankingsController@ranking_category_pdf');