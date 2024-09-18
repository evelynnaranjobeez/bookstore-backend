<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateWithToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken(); // Obtener el token del header "Authorization"

        // Buscar un usuario con el token proporcionado
        $user = User::where('token', hash('sha256', $token))->first();

        if (!$user) {
            return response()->json(['message' => 'No autorizado.'], 401);
        }

        // Autenticar al usuario
        auth()->login($user);

        return $next($request);
    }
}
