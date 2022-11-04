<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\UserController;
use App\Http\controllers\CandidateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[App\Http\Controllers\api\UserController::class,'login']);




Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('/leads',[App\Http\Controllers\api\CandidateController::class,'index' ]);
    Route::post('/candidates',[App\Http\Controllers\api\CandidateController::class,'store' ])->middleware('role');
    Route::get('/lead/{id}',[App\Http\Controllers\api\CandidateController::class,'show' ]);

});