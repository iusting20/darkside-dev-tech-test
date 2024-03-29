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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// this function within the CustomerController will add a user to our database / disk
Route::post('/add_customer_to_disk', [CustomerController::class, 'store_on_disk']);
Route::post('/add_customer_to_database', [CustomerController::class, 'store_in_database']);
