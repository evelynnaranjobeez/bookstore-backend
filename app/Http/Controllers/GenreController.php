<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    // Get all genres
    public function index()
    {
        $genres = Genre::all(); // Retrieve all genres
        return response()->json($genres, 200);
    }

    // Show a specific genre by ID
    public function show($id)
    {
        $genre = Genre::find($id); // Find genre by ID

        if (!$genre) {
            return response()->json(['message' => 'Genre not found'], 404);
        }

        return response()->json($genre, 200);
    }

    // Create a new genre
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre = Genre::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Genre created successfully!',
            'data' => $genre
        ], 201);
    }

    // Update an existing genre
    public function update(Request $request, $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(['message' => 'Genre not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Genre updated successfully!',
            'data' => $genre
        ], 200);
    }

    // Delete a genre
    public function destroy($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(['message' => 'Genre not found'], 404);
        }

        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Genre deleted successfully!'
        ], 200);
    }
}
