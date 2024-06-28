<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $token = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            // return response()->json(['error' => 'Token inválido'], 404);
            return response()->json([
                'data' => [
                    'error' => 'Token inválido!'
                ]
            ], 401);
        }

        return $next($request);
    }
}
