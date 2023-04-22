<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/tasks", [TaskController::class, "index"]);
Route::post("/tasks/store", [TaskController::class, "store"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
