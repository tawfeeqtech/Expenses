<?php

use App\Http\Controllers\Api\TreatmentController;
use App\Http\Controllers\Api\TreatmentDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/transactions/wallets', [TreatmentDataController::class, 'wallets']);
Route::get('/transactions/contacts', [TreatmentDataController::class, 'contacts']);
Route::get('/transactions/{type}/sections', [TreatmentDataController::class, 'sections']);
Route::get('/transactions/{section}/subsections', [TreatmentDataController::class, 'subsections']);


Route::apiResource('transactions',TreatmentController::class);
