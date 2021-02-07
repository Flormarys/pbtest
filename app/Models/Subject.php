<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory; // this probably is not need it.

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subjects';

    /**
     * This action will make the protected field can be filled
     */

    protected $fillable = ['id'];

    /**
     * This will avoid the timestamp as it is not necessary
     */

    public $timestamps = false;

}
