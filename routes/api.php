<?php

use App\Http\Controllers\SWAPIController;
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

Route::get('/swapi/{resource}', [SWAPIController::class, 'getResourceList']);

Route::get('/swapi/{resource}/{id}', [SWAPIController::class, 'getResource'])->where('id', '[0-9]+');;

Route::get('/swapi/{resource}/schema', [SWAPIController::class, 'getResourceSchema']);
