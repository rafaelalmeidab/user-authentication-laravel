<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model implements AuthenticatableContract, JWTSubject
{
    use Authenticatable;
    protected $table = 'usuarios'; // Nome da tabela no banco de dados
    protected $primaryKey = 'ID'; // Nome da chave primária, se diferente de 'id'

    /**
     * Busca um usuário pelo nome.
     *
     * @param string $nome
     * @return Usuario|null
     */
    public static function findUserByName($nome)
    {
        return self::select('ID', 'NOME', 'SENHA')
                    ->where('NOME', $nome)
                    ->first();
    }

    /**
     * Listar usuários.
     */
    public static function listUsers()
    {
        return self::select('ID', 'NOME')->get();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}