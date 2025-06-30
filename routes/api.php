<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SensorController;
use App\Http\Controllers\Api\SensorController as ApiSensorController;


Route::get('/sensor', [SensorController::class, 'index']);
Route::get('/sensor/{id}', [SensorController::class, 'show']);
Route::post('/sensor', [ApiSensorController::class, 'store']);
Route::put('/sensor/{id}', [ApiSensorController::class, 'update']);
Route::delete('/sensor/{id}', [ApiSensorController::class, 'delete']);