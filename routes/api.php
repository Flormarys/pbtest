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



// Returns all subjects
Route::get('/subjects', [SubjectController::class, 'subjectList']);

// Returns one subject
Route::get('/subject/{id}', [SubjectController::class, 'subject']);


// Returns all books with his subject
Route::get('/books', [BookController::class, 'booksList']);


// Returns one book with his subject
Route::get('/book/{id}', [BookController::class, 'relatedBooks']);

/*

Route::get('/booksList', function () {
    return BookResource::collection(Book::all());
});
Route::get('/listsubject', function () {
    return SubjectResource::collection(Subject::all());
});

Route::get('/listbooks', function () {
	$books = Book::all();
	$books = $books->fresh();
    return new BookCollection($books->fresh('subject'));
});

Route::get('/booklist', function () {
    return new BookCollection(Book::all());
});

Route::get('/list', function () {
    return BookResource::collection(Book::all());
});

return new DeviceInspectionResource(DeviceInspection::with('sale')->findOrFail($id));

|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|



Route::get('/users', function () {
    return new UserCollection(User::all());
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

*/




