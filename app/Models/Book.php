<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'isbn',
        'cover_image',
        'publication_year',
        'publisher',
        'total_copies',
        'available_copies',
        'category_name',
    ];
}
