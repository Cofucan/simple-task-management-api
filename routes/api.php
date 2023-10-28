<?php

use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// api/v1
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {

    Route::apiResource('tasks', TaskController::class);

    // // api/v1/tasks
    // Route::group(['prefix' => 'tasks'], function () {
    //     // api/v1/tasks
    //     Route::get('/', 'TaskController@index');
    //     // api/v1/tasks/{task}
    //     Route::get('/{task}', 'TaskController@show');
    //     // api/v1/tasks
    //     Route::post('/', 'TaskController@store');
    //     // api/v1/tasks/{task}
    //     Route::put('/{task}', 'TaskController@update');
    //     // api/v1/tasks/{task}
    //     Route::delete('/{task}', 'TaskController@destroy');
    // });
});
