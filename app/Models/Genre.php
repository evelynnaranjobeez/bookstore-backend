<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name'];

// Relationship with books
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
