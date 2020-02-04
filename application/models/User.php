<?php

namespace application\models;

use application\core\Model;

class User extends Model
{

    public function getUsers($login)
    {
        $params = [
            'login' => $login,
        ];
        $result = $this->db->query('SELECT * FROM users WHERE login = :login', $params)->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }
}