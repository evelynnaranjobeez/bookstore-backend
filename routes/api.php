<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorldBankController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [UserController::class, 'login']);


//Routes that only admin can access
Route::get('/life_expectancy', [WorldBankController::class, 'fetchLifeExpectancyData'])->middleware('auth:sanctum', \App\Http\Middleware\AdminMinddleware::class);


//Routes that only authenticated users can access
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/get_authors', [AuthorController::class, 'getAllAuthors']);
    Route::get('/get_books_with_filter', [BookController::class, 'getAllBooksWithFilter']);
    Route::get('/get_books_with_pagination', [BookController::class, 'getAllBooksWithPagination']);
    Route::get('/books_chart_data', [BookController::class, 'getBooksChartData']);

    // Genre routes
    Route::get('/genres', [GenreController::class, 'index']); // Get all genres

    // Language routes
    Route::get('/languages', [LanguageController::class, 'index']); // Get all languages
});


// Rutas que no requieren autenticación
Route::resource('authors', AuthorController::class);
Route::resource('books', BookController::class);
Route::resource('users', UserController::class);
Route::post('/books', [BookController::class, 'store']);

