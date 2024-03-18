<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//Persons routes
Route::prefix('persons')->group(function () {
    Route::post('/store', [PersonController::class, 'store']);
    Route::post('/update', [PersonController::class, 'update']);
    Route::get('/delete/{personid?}', [PersonController::class, 'delete_person']);
    Route::get('/get/{personid?}', [PersonController::class, 'fetch_person']);
    Route::get('/', [PersonController::class, 'fetch']);
});
