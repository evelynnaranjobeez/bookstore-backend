<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        // Obtener todos los autores
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    public function store(Request $request)
    {
        // Validar y crear un nuevo autor
        $author = Author::create($request->all());
        return redirect()->back();
    }

    public function getAllAuthors()
    {
        $authors = Author::all(); // Obtener todos los autores
        return response()->json($authors); // Retornar en formato JSON
    }
    // Otros métodos para editar, actualizar y eliminar autores
}
