<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{
    /**
    * Return books list filtered by get parameters.
    *
    * @param Request $request
    * @return BookCollection
    */

    public function index(Request $request)
    {
        $validated = Validator::make(
            $request->all(), 
            [
                'search' => 'string|max:255',
                'subject' => 'integer',
                'page' => 'integer|min:1',
                'is_original' => 'boolean',
                'per_page'  => 'integer|min:1'
            ]
        );

        if ($validated->fails()) {
            return response()->json([
                'error' => true,
                'messages' => $validated->errors()->all()
            ]);
        }

        $books = Book::getBooksFiltered($request);
        $books = Book::getBooksPaginatedByGetParameter($books, $request);
        return BookResource::collection($books);
    }

}
