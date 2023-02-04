<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\groupController;

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);

Route::get('/groups', [GroupController::class, 'index']);
Route::post('/groups', [GroupController::class, 'store']);
Route::get('/groups/{id}', [GroupController::class, 'show']);
Route::put('/groups/{id}', [GroupController::class, 'update']);


Route::post('/group/users/', [UserController::class, 'createUserInGroup']);
Route::get('/users/check/{id}', [UserController::class, 'checkUserActiveStatus']);
Route::post('/users/group', [UserController::class, 'addUsersToGroup']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
