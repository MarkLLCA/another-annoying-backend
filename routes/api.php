<?php

use App\Http\Middleware\checker;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Container\Attributes\Auth;


// crud operations for books
Route::get('books', [\App\Http\Controllers\Api\BooksController::class, 'index']);
Route::post('books', [\App\Http\Controllers\Api\BooksController::class, 'store']);
Route::get('books/{book}', [\App\Http\Controllers\Api\BooksController::class, 'show']);
Route::put('books/{book}', [\App\Http\Controllers\Api\BooksController::class, 'update']);
Route::patch('books/{book}', [\App\Http\Controllers\Api\BooksController::class, 'update']);
Route::delete('books/{book}', [\App\Http\Controllers\Api\BooksController::class, 'destroy']);





// register, login, logout
Route::post('register', [\App\Http\Controllers\Api\UserController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Api\UserController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\Api\UserController::class, 'logout'])->middleware('auth:sanctum');


























// Route::apiResource('books', \App\Http\Controllers\Api\BooksController::class);
// Route::get('userbooks', [\App\Http\Controllers\Api\BooksController::class, 'index']);









// Route::get('user', function (Request $request) {
//      return response()->json([
//         'user' => $request->user(),
//     ]);
// })->middleware('auth:sanctum');
