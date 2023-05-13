<?php

use App\Http\Controllers\API\FieldController;
use App\Http\Controllers\API\FormController;
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

require __DIR__ . '/auth.php';

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'middleware' => ['auth:sanctum', 'verified'],
    'prefix' => 'forms'
], function () {
    Route::get('/', [FormController::class, 'index']);
    Route::post('/', [FormController::class, 'store']);
    Route::get('/{form}', [FormController::class, 'show']);
    Route::put('/{form}', [FormController::class, 'update']);
    Route::delete('/{form}', [FormController::class, 'destroy']);


    Route::group([
        'prefix' => '{form}/fields'
    ], function () {
        Route::post('/', [FieldController::class, 'storeField']);
        Route::put('/{field}', [FieldController::class, 'updateField']);
        Route::delete('/{field}', [FieldController::class, 'destroyField']);
    });
});
