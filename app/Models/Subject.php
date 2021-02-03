<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Subject extends Model
{
    use HasFactory; // this probably is not need it.

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subjects';

    protected $fillable = ['id'];

    public $timestamps = false;

    public function subjects()
    {
        return $this->hasMany(Book::class);
    }

}
