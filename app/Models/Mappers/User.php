<?php

namespace app\Models\Mappers;

use WheelPhp\Core\Db\Db;

class User
{
    public function fetchById(int $id)
    {
        $query = "SELECT * FROM users where id = $id";

        $queryResult = Db::query($query);

        $user = $this->fromArray($queryResult->fetch_assoc());

        return $user;
    }
    public function fromArray(?array $params) : ?\app\Models\User
    {
        if (!$params) {
            return null;
        }
        $user = new \app\Models\User();
        $user->setId($params['id']);
        $user->setName($params['name']);
        $user->setEmail($params['email']);
        return $user;
    }
}