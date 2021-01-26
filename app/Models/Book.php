<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;

class Book extends Model
{
    use HasFactory;

    return $this->hasMany(Subject::class);
}
