<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use App\Models\Subject;
use Illuminate\Http\Request;


class Book extends Model implements Authenticatable
{
    use HasFactory;

    use AuthenticableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * This will avoid the timestamp as it is not necessary
     */

    public $timestamps = false;

    /**
     * This action will make the protected field can be filled
     */

    protected $fillable = ['subject_id'];

    const PER_PAGE_DEFAULT = 10;

    /**
     * One book has one subject.
     */   

    public function subject()
    {
        return $this->hasOne(Subject::class);
    }

    public static function getBooksFiltered(Request $request) 
    {
        $books = Subject::join('books', 'books.subject_id','=','subjects.id');
        if ($request->has('search')) {
            $books = self::getBooksFilteredBySearch($books, $request->input('search'));
        }   

        if($request->has('is_original')) {
            $books = self::getBooksFilteredByIsOriginal(
                $books, 
                $request->input('is_original')
            );      
        }

        if($request->has('subject')) {
            $books = self::getBookdFilteredBySubjectId($books, $request->input('subject'));
        }
        return $books;
    }

    public static function getBooksPaginatedByGetParameter($books, Request $request) {
        $per_page = $request->has('per_page') ? 
            $request->input('per_page') : self::PER_PAGE_DEFAULT;
        $books = $books->paginate($per_page);
        return $books;
    }

    public static function getBooksFilteredBySearch($books, string $stringSearch) 
    {
        return $books
            ->orWhere('books.title', 'like', '%' . $stringSearch . '%')
            ->orWhere('subjects.name', 'like', '%' . $stringSearch . '%');
    }

    public static function getBooksFilteredByIsOriginal($books, int $isOriginal) 
    {
        return $books->where('books.is_original', '=', $isOriginal);
    }

    public static function getBookdFilteredBySubjectId($books, int $subject)
    {
        return $books->where('books.subject_id', '=', $subject);
    }

}
