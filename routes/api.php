<?php

use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoiceStatusController;
use App\Http\Controllers\PaymentServicesController;
use App\Http\Controllers\WorkServicesController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('invoice', InvoicesController::class);
Route::resource('invoice_status', InvoiceStatusController::class);
Route::resource('work_services', WorkServicesController::class);
Route::resource('payment_services', PaymentServicesController::class);

// Route::get('/invoice', [InvoicesController::class, 'index']);
// Route::put('/invoice', [InvoicesController::class, 'update']);
// Route::delete('/invoice', [InvoicesController::class, 'destroy']);
// Route::post('/invoice', [InvoicesController::class, 'store']);


