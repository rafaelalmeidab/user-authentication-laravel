<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Exibe a lista de todos os usuários.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function users()
    {
        $usuarios = Usuarios::listUsers();
        
        if($usuarios->isEmpty()) {
            return response()->json(['message' => 'Nenhum usuário encontrado'], 401);
        }

        return response()->json($usuarios);
    }
}
