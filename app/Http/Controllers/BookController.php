<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Subject;
use App\Http\Controllers\SubjectController;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\SubjectCollection;


class BookController extends Controller
{
    /**
     * List all books.
     *
     * @param Request $request
     * @return BookCollection
     */
    public function booksList()
     {
        return BookResource::collection(Book::all());
     }

    public function book($id)
    {
        return Book::find($id);
    }

    public function relatedBooks($id)
    {
      $allBooks = BookResource::collection(Book::all());
      return $allBooks->whereIn('subject_id', Subject::find($id));

    }

}

