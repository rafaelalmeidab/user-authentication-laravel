<?php

namespace App\Http\Controllers;

use App\Helpers\PasswordHelper;
use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request){
        $user     = $request->input('user');
        $password = $request->input('password');

        $result = Usuarios::findUserByName($user);
        if(is_null($result)) {
            return response()->json([
                'message' => 'Usuário não encontrado.',
                'data' => [
                    'user' => $user
                ]
            ], 401);
        }  
         
        $validatePassword = PasswordHelper::compareMd5($password, $result->SENHA);

        if (!$validatePassword) {
            return response()->json([
                'data' => [
                    'message' => 'Usuário e/ou senha não encontrado(s)!'
                ]
            ], 401);
        }  

        // Valide os dados do usuário (exemplo simples)
        $credentials = $request->only('user', 'password');

        // Encontrar o usuário pelo email
        $user = Usuarios::where('NOME', $credentials['user'])->first();

        // Verificar se o usuário existe e se a senha MD5 está correta
        if ($user && $result->SENHA === md5($credentials['password'])) {
            // Gerar o token JWT
            if (is_null($user->getJWTIdentifier())) {
                return response()->json(['error' => 'Identificador do usuário é nulo'], 500);
            }

            // Gerar o token JWT
            $token = JWTAuth::fromUser($user);

            // Token JWT gerado com sucesso, retorne o token
            return response()->json([
                'data' => [
                    'message' => 'Login realizado com sucesso!',
                    'token' => $token
                ]
            ], 200);
        }
    }
}   
