<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/buildings', ['as' => 'buildings', 'uses' => 'BuildingController@index']);
Route::get('/buildings/create', ['as' => 'building.create', 'uses' => 'BuildingController@create']);
Route::post('/buildings', ['as' => 'buildings', 'uses' => 'BuildingController@store']);
Route::get('/buildings/{building}/show', ['as' => 'building.show', 'uses' => 'BuildingController@show']);

Route::get('/buildings/{building}/edit', ['as' => 'building.edit', 'uses' => 'BuildingController@edit']);

Route::post("/plan/upload", ['as' => 'plan.upload', 'uses' => 'PlanController@uploadFile']);
Route::get("/plan/{plan}/download", ['as' => 'plan.download', 'uses' => 'PlanController@downloadFile']);
Route::get("/plan/edit/{plan}", ['as' => 'plan.edit', 'uses' => 'PlanController@edit']);
Route::post("/plan/update/{plan}", ['as' => 'plan.update', 'uses' => 'PlanController@update']);

Route::get('/roles', 'RoleController@index');
Route::post('/roles', 'RoleController@store');
Route::get('/roles/edit/{id}', 'RoleController@edit');
Route::post('/roles/edit/{id}', ['as' => 'roles.update', 'uses' => 'RoleController@update']);

Route::get('/users', 'UsersController@index');