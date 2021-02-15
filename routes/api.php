<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Book;
use App\Http\Controllers\BookController;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookCollection;

use App\Models\Subject;
use App\Http\Controllers\SubjectController;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\SubjectCollection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/books', [BookController::class, 'allParameters']);

// Returns all subjects
//Route::get('/books', [BookController::class, 'paginatedBooks']);








