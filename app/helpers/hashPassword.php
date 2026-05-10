<?php

    class HashPassword{
        public static function passwordHash($password){
            return password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        }
    }

?>