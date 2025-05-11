<?php

use App\Http\Controllers\Api\AuthApicontroller;
use App\Http\Controllers\Api\BookingApicontroller;
use App\Http\Controllers\Api\EventApicontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthApicontroller::class, 'register']);
Route::post('/login',[AuthApicontroller::class, 'login']);
Route::post('/logout',[AuthApicontroller::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {

Route::prefix('events')->group(function () {
    Route::post('/store', [EventApicontroller::class, 'store']);
    Route::post('/update/{id}', [EventApicontroller::class, 'update']);
    Route::post('/delete/{id}', [EventApicontroller::class, 'delete']);
     Route::get('/show/{id}',[EventApicontroller::class,'show']);


         Route::post('/booking/{id}',[BookingApicontroller::class,'book']);
    Route::post('/cancelbooking/{id}',[BookingApicontroller::class,'cancel']);

});







});