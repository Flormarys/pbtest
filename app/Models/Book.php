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

    /**
     * This will avoid the timestamp as it is not necessary
     */

    public $timestamps = false;

    /**
     * This action will make the protected field can be filled
     */

    protected $fillable = ['subject_id'];

    /**
     * One book has one subject.
     */   

    public function subject()
    {

        return $this->hasOne(Subject::class);

    }

}
