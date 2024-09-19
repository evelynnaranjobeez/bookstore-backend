<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class TokenAuth
{
    public function handle($request, Closure $next)
    {
        // Get the token from the request header
        $token = $request->bearerToken();

        // Check if the token matches the one in the database
        $user = User::where('token', $token)->first();

        if (!$user) {
            // Return unauthorized response if token does not match
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Proceed to the next request
        return $next($request);
    }
}
