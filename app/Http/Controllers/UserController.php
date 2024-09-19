<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        return view('users.create');
    }

    // Save a new user in the database
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|max:50',
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptar la contraseña
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    // Show user
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Edit user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|max:50',
        ]);

        $user->update([
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Solo actualizar si se proporcionó una nueva contraseña
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }


    //Login user
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        // Search for user
        $user = User::where('email', $request->email)->first();

        // Verify the user
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        // Generate token
        $token = $user->createToken('API Token')->plainTextToken;

        //Put token in user
        $user->token = $token;
        $user->save();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Logged in successfully!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $user->only(['id', 'email', 'role','token']),
        ], 200);
    }


}
