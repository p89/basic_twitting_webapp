<?php

class passHandler
{
    public static function hashPass ($password) {

        $salt = self::generateRandom();
        $toHash = $password . $salt;
        $options = [
            'cost' => 12
        ];
        $hashed = password_hash($toHash, PASSWORD_DEFAULT, $options);
        return [$hashed, $salt];
    }

    public static function generateRandom () {

        return rand(1000, 9999);
    }

    public static function verifyPass ($password, $hash) {
        return password_verify($password, $hash);
    }
}


$malyhash = passHandler::hashPass("ania");
var_dump($malyhash);
$pass = 'ania' . $malyhash[1];
var_dump(passHandler::verifyPass($pass, $malyhash[0]));