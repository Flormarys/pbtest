<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Subject extends Model
{
    use HasFactory;

    return $this->belongsTo(Book::class);
}
