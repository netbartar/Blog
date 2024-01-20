<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
      'title', 'body', 'publication_date', 'publication_status', 'author_id', 'file_id'
    ];
}
