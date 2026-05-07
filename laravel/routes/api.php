<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// app.get("/user", sanctum, (req, res) => {
// })

Route::post('/register', [AuthController::class, 'register']);

Route::get('/test', function (Request $request) {
    dd($request);
});