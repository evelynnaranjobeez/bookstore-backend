<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('authors', AuthorController::class);
Route::resource('books', BookController::class);
Route::resource('users', UserController::class);

Route::post('/books', [BookController::class, 'store']);

Route::get('/get_authors', [AuthorController::class, 'getAllAuthors']);
Route::get('/get_books_with_filter', [BookController::class, 'getAllBooksWithFilter']);
Route::get('/get_book/{id}', [BookController::class, 'getBookById']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/get_books_with_pagination', [BookController::class, 'getAllBooksWithPagination']);

