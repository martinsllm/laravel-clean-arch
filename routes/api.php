<?php

use App\Http\Controllers\API\BookApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(BookApiController::class)
    ->prefix('/books')
    ->group(function () {
        Route::post('/', 'store');
        Route::post('/{book_code}/pdf', 'convertBook');
    });
