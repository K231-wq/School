<?php

namespace App\controllers\auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class  Authentication{

    public static function getSecretKey() {
        return $_ENV['JWT_SECRET'];
    }

    public static function createJWT($user){
        $payload = [
            'iat' => time(),
            'exp' => time() + 60*60*24*30,
            'user' => $user
        ];
        $token = JWT::encode($payload, self::getSecretKey(), 'HS256');
        return $token;
    }

    public static function verifyJWT($token){
        try {
            $decoded = JWT::decode($token, new Key(self::getSecretKey(), 'HS256'));
            return $decoded;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

?>