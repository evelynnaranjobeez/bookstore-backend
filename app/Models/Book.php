<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = ['title', 'author_id', 'year', 'genre_id', 'language_id', 'description'];

    // Relationship with author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Relationship with genre
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    // Relationship with language
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
