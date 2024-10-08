<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;


    protected $table = 'authors';

    protected $fillable = ['name', 'birth_date'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function getBooksWrittenAttribute()
    {
        return $this->books()->count();
    }
}
