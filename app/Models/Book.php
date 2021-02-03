<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;

class Book extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'books';

    public $timestamps = false;

    protected $fillable = ['subject_id'];

    public function oneSubject()
    {

    return $this->hasOne(Subject::class);

    }

}
