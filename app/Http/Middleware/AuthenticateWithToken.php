<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateWithToken
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken(); // Get the token from the request header

        // Check if the token matches the one in the database
        $user = User::where('token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401); // Unauthorized if the token doesn't match
        }

        // Proceed with the request
        return $next($request);
    }

}
