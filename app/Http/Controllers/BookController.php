<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{
    /**
    * List all books.
    *
    * @param Request $request
    * @return BookCollection with Subject relationship
    */

    public function allParameters(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'search' => 'string|max:255',
            'subject' => 'integer',
            'page' => 'integer',
            'is_original' => 'boolean',
            'per_page'  => 'integer'
        ]);

        if ($validated->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validated->errors()->all()
            ]);
        }

        $books = Subject::join('books', 'books.subject_id','=','subjects.id');
        if ($request->has('search')) {
            $books = $books
                ->orWhere('books.title', 'like', '%' . $request->input('search') . '%')
                ->orWhere('subjects.name', 'like', '%' . $request->input('search') . '%');
            }

        if($request->has('is_original')) {
            $books = $books->where('books.is_original', '=', $request->input('is_original'));          
        }

        if($request->has('subject')) {
            $books = $books->where('books.subject_id', '=', $request->input('subject'));
        }

        $per_page = $request->has('per_page') ? $request->input('per_page') : 10;

        $books = $books->paginate($per_page);

        return BookResource::collection($books);
    }

}
