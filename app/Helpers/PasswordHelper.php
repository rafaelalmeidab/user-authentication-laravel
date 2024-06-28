<?php

namespace App\Helpers;

class PasswordHelper
{
    /**
     * Compara uma senha não criptografada com um hash MD5.
     *
     * @param string $informedPassword
     * @param string $hashedPassword
     * @return bool
     */
    public static function compareMd5($informedPassword, $hashedPassword)
    {
        return md5($informedPassword) === $hashedPassword;
    }
}
