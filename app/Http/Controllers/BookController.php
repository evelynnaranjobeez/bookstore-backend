<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // Show all books
    public function index()
    {
        // Load books with author, genre, and language relationships
        $books = Book::with(['author', 'genre', 'language'])->get();
        return view('books.index', compact('books'));
    }

    // Show the form for creating a new book
    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        $languages = Language::all();
        return view('books.create', compact('authors', 'genres', 'languages'));
    }

    // Save a new book in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'year' => 'required|integer',
            'genre_id' => 'required|exists:genres,id',  // Validate genre
            'language_id' => 'required|exists:languages,id',  // Validate language
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

    // Show a specific book
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Edit a specific book
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    // Update a specific book in the database
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'year' => 'required|integer',
            'genre_id' => 'required|exists:genres,id',  // Validate genre
            'language_id' => 'required|exists:languages,id',  // Validate language
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

    // Delete a specific book from the database
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

        // Base query to get all books with author relationship
        $query = Book::with('author');

        // Filter by title
        if ($request->has('title')) {
            $query->where('title', 'LIKE', '%' . $request->input('title') . '%');
        }

        // Filter by genre
        if ($request->has('language')) {
            $query->where('language', $request->input('language'));
        }

        // Filter by author name
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

        // Get limit and offset from the request
        $limit = $request->input('limit', 10);  // Number of books per page
        $offset = $request->input('offset', 0);  // Offset for pagination
        $search = $request->input('search', ''); // Search keyword

        // Base query to get all books with related author, genre, and language data
        $query = Book::with(['author' => function($query) {
            // Add books_count to the author model
            $query->withCount('books');
        }, 'genre', 'language']);

        // Apply search filter
        if (!empty($search)) {
            $query->where('title', 'LIKE', '%' . $search . '%')
                ->orWhereHas('author', function($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                });
        }

        // Count total number of books
        $total = $query->count();

        // Apply limit and offset to the query
        $books = $query->limit($limit)->offset($offset)->get();

        // Return the paginated books as JSON response
        return response()->json([
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset,
            'data' => $books,
        ]);
    }


    public function getBookById($id)
    {
        // Search for the book by ID with author relationship
        $book = Book::with('author')->find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        // Return the book as JSON response
        return response()->json($book);
    }

}
