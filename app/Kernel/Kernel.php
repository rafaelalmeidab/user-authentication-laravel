<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Outros middlewares
    protected $middlewareGroups = [
        'web' => [
            // Middlewares de sessão, cookies, etc.
        ],

        'api' => [
            'throttle:api',
            'jwt.auth', // Middleware JWT
            // Outros middlewares de API
        ],
    ];

    // Outros métodos do Kernel
}
