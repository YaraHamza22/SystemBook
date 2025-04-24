<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/book',[BookController::class,'index']);
Route::post('/book',[BookController::class,'store']);
Route::get('/book/{id}',[BookController::class,'show']);
Route::put('/book/update/{id}',[BookController::class,'update']);
Route::delete('/book/delete/{id}',[BookController::class,'delete']);

Route::get('/author',[AuthorController::class,'index']);
Route::post('/author',[AuthorController::class,'store']);
Route::get('/author/{id}',[AuthorController::class,'show']);
Route::put('/author/update/{id}',[AuthorController::class,'update']);
Route::delete('/author/delete/{id}',[AuthorController::class,'delete']);

