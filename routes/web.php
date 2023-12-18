<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::any('/', function() {
    return response()->json([
        'status'   => 'error',
        'message' => 'Route not found.'
    ], Response::HTTP_NOT_FOUND );
})->where('path', '.*');
