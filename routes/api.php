<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/persons', [PersonController::class, 'showAll']);

Route::post('/persons', [PersonController::class, 'createPersons']);

Route::get('/persons/{id}', [PersonController::class, 'show']);
    
Route::put('/persons/{id}', [PersonController::class, 'update']);

Route::delete('/persons/{id}', [PersonController::class, 'destroyPersons']);
