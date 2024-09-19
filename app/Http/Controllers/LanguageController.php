<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    // Get all languages
    public function index()
    {
        $languages = Language::all(); // Retrieve all languages
        return response()->json($languages, 200);
    }

    // Show a specific language by ID
    public function show($id)
    {
        $language = Language::find($id); // Find language by ID

        if (!$language) {
            return response()->json(['message' => 'Language not found'], 404);
        }

        return response()->json($language, 200);
    }

    // Create a new language
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $language = Language::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Language created successfully!',
            'data' => $language
        ], 201);
    }

    // Update an existing language
    public function update(Request $request, $id)
    {
        $language = Language::find($id);

        if (!$language) {
            return response()->json(['message' => 'Language not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $language->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Language updated successfully!',
            'data' => $language
        ], 200);
    }

    // Delete a language
    public function destroy($id)
    {
        $language = Language::find($id);

        if (!$language) {
            return response()->json(['message' => 'Language not found'], 404);
        }

        $language->delete();

        return response()->json([
            'success' => true,
            'message' => 'Language deleted successfully!'
        ], 200);
    }
}
