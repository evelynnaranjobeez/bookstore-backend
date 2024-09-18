<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = ['title', 'author_id', 'year', 'genre', 'language', 'description'];

    // Relación con el autor (muchos libros pertenecen a un autor)
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
