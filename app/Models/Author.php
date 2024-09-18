<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no es la predeterminada
    protected $table = 'authors';

    // Campos que se pueden rellenar en la tabla
    protected $fillable = ['name', 'birth_date'];

    // Relación con los libros (un autor tiene muchos libros)
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
