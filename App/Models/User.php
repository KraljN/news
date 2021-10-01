<?php

namespace App\Models;

class User extends Model{

    public function getUser($username, $password){
        $query = "SELECT  *
                  FROM admins
                  WHERE username = ? AND password = ?";
        return $this->preparedQuery($query, [$username, $password], true);
    }
}