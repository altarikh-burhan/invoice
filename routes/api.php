<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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
Route::get('city', [CustomerController::class, 'getCity'])->name('city'); //ROUTE API UNTUK /CITY
Route::get('district', [CustomerController::class, 'getDistrict'])->name('district'); //ROUTE API UNTUK /DISTRICT


