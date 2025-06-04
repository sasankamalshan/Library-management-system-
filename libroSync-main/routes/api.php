<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/books', [BookController::class, 'index']);
Route::post('/books/borrow/{id}', [BookController::class, 'borrow']);
Route::post('/books/return/{id}', [BookController::class, 'returnBook']);
Route::get('/books/borrowed', [BookController::class, 'borrowed']);
