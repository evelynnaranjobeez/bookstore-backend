<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // This method retrieves all authors and returns them to the view for display
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    // This method validates and stores a new author in the database
    public function store(Request $request)
    {
        $author = Author::create($request->all()); // Create a new author with validated data
        return redirect()->back();
    }

    // This method retrieves all authors along with a count of how many books each has written
    public function getAllAuthors()
    {
        $authors = Author::withCount('books')->get(); // Fetch all authors and count related books
        return response()->json($authors); // Return the data as a JSON response
    }

}
