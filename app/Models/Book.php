<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['book_code', 'title', 'description', 'price', 'book_path', 'slug'];
}
