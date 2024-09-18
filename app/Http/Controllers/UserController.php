<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // Mostrar la lista de usuarios
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

    // Guardar un nuevo usuario en la base de datos
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

    // Mostrar un solo usuario
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Mostrar el formulario para editar un usuario
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Actualizar un usuario en la base de datos
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

    // Eliminar un usuario de la base de datos
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

    public function login(Request $request)
    {

        // Validar los datos de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Buscar al usuario por su email
        $user = User::where('email', $request->email)->first();

        // Verificar si el usuario no existe
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado',
            ], 404); // Código 404: No encontrado
        }

        // Verificar si la contraseña es correcta
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        // Generar un token único
        $token = Str::random(80); // Genera un token de 80 caracteres

        // Guardar el token en la tabla `users`
        $user->forceFill([
            'token' => hash('sha256', $token), // Guardar el token hasheado
        ])->save();

        // Retornar el token al cliente
        return response()->json([
//            'access_token' => $token, // El token en formato plano (no hasheado)
//            'token_type' => 'Bearer',
        'success' => true,
            'message' => 'Logged in successfully!',
            'data' => $user->only(['id', 'email', 'role', 'token']), // Datos del usuario autenticado
        ], 200); // Código 200: OK
    }

}
