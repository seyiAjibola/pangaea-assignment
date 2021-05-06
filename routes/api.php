<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PangaeaController;

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
/*
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
        Route::get('/user', function( Request $request ){
        return $request->user();
        });
    });
*/
Route::group(['prefix' => 'v1', 'middleware' => ['cors', 'json.response']], function(){
    Route::post('/subscribe/{topic}', [PangaeaController::class,'subscribe'])->name('subscribe.api');
    Route::post('/publish/{topic}', [PangaeaController::class,'publish'])->name('publish.api');
  });
