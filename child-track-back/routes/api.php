<?php

use App\Http\Controllers\Api\Extra\WilayaController;
use App\Http\Controllers\Api\Main\AdminsController;
use App\Http\Controllers\Api\Main\BracletController;
use App\Http\Controllers\Api\Main\ChildrenController;
use App\Http\Controllers\Api\Main\GurdiansController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return response()->json([
        "message" => "hello",
        "user" => $request->user()->load('key.keyable')
    ]);
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/admins', AdminsController::class);
    Route::post('/admins/{admin}/generate-key', [AdminsController::class, 'createKey']);
    Route::apiResource('/gurdians', GurdiansController::class)->except('store');
    Route::post('/gurdians/{gurdian}/generate-key', [GurdiansController::class, 'createKey']);
    Route::post('/gurdians/{gurdian}/phones', [GurdiansController::class, 'storePhone']);
    Route::match(['patch', 'put'], '/gurdians/{gurdian}/phones/{phone}', [GurdiansController::class, 'updatePhone']);
    Route::apiResource('/childrens', ChildrenController::class);
    Route::apiResource('/braclets', BracletController::class);
    Route::post('/braclets/{id}/children', [BracletController::class, 'linkChild']);
    Route::post('/braclet/connect', [\App\Http\Controllers\Api\Main\BracletController::class, 'connect']);
});

Route::apiResource('/gurdians', GurdiansController::class)->only('store');

Route::get('/wilayas', [WilayaController::class, "index"]);


require __DIR__ . '/auth.php';
