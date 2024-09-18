<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Global middleware
    ];

    protected $middlewareGroups = [
        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];


    protected $routeMiddleware = [
       // 'auth' => \App\Http\Middleware\Authenticate::class,
        'token-auth' => \App\Http\Middleware\TokenAuth::class,  // Add custom middleware here
        // other middleware
    ];
}
