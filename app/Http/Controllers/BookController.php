<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Mostrar la lista de libros
    public function index()
    {
        $books = Book::with('author')->get(); // Cargar también la relación del autor
        return view('books.index', compact('books'));
    }

    // Mostrar el formulario para crear un nuevo libro
    public function create()
    {
        $authors = Author::all(); // Obtener todos los autores para seleccionarlos al crear un libro
        return view('books.create', compact('authors'));
    }

    // Guardar un nuevo libro en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'year' => 'required|integer',
            'genre' => 'required|string|max:100',
            'language' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);

        try {
            // Crear el libro con los datos validados
            $book = Book::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Book created successfully!',
                'data' => $book
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Book creation failed!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Mostrar un solo libro
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Mostrar el formulario para editar un libro
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    // Actualizar un libro en la base de datos
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'year' => 'required|integer',
            'genre' => 'required|string|max:100',
            'language' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);

        try{
            $book->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Book updated successfully!',
                'data' => $book
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Book update failed!',
                'error' => $e->getMessage()
            ]);
        }
    }

    // Eliminar un libro de la base de datos
    public function destroy(Book $book)
    {
        try{
            $book->delete();
            return response()->json([
                'success' => true,
                'message' => 'Book deleted successfully!',
                'data' => $book
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Book delete failed!',
                'error' => $e->getMessage()
            ]);
        }

    }

    public function getAllBooksWithFilter(Request $request)
    {
        // Consulta base para obtener todos los libros
        $query = Book::with('author');

        // Filtro por nombre del libro
        if ($request->has('title')) {
            $query->where('title', 'LIKE', '%' . $request->input('title') . '%');
        }

        // Filtro por idioma del libro
        if ($request->has('language')) {
            $query->where('language', $request->input('language'));
        }

        // Filtro por nombre del autor
        if ($request->has('author')) {
            $query->whereHas('author', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->input('author') . '%');
            });
        }

        $books = $query->get();

        return response()->json($books);
    }


    public function getAllBooksWithPagination(Request $request)
    {
        // Obtener parámetros de paginación y búsqueda
        $limit = $request->input('limit', 10);  // Número de resultados por página
        $offset = $request->input('offset', 0);  // Desplazamiento inicial
        $search = $request->input('search', ''); // Búsqueda por título, autor, etc.

        // Consulta base para obtener todos los libros (sin limit y offset)
        $query = Book::with('author');

        // Aplicar búsqueda si se proporciona
        if (!empty($search)) {
            $query->where('title', 'LIKE', '%' . $search . '%')
                ->orWhereHas('author', function($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                });
        }

        // Contar el total de resultados sin limit y offset
        $total = $query->count();

        // Aplicar paginación: limit y offset
        $books = $query->limit($limit)->offset($offset)->get();

        // Retornar los resultados en formato JSON con paginación
        return response()->json([
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset,
            'data' => $books,
        ]);
    }




    public function getBookById($id)
    {
        // Buscar el libro por su ID
        $book = Book::with('author')->find($id);

        // Si el libro no existe, retornar un error 404
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        // Retornar el libro en formato JSON
        return response()->json($book);
    }

}
