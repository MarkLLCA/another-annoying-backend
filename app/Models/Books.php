<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = [
        'title',
        'author',
        'genre',
        'publication_date',
    ];

    public $timestamps = false;
}
