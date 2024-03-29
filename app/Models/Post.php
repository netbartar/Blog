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

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,
            'category_posts', 'post_id', 'category_id');
    }

    public function scopeGetPost()
    {
        return $this->select('id', 'title', 'publication_date', 'publication_status', 'author_id')
            ->with('author:id,name');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
