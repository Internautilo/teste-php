<?php

namespace App\Controllers;

use App\Models\User\UserModel;
use Database\MySQL\MySQL;

class UserController extends UserModel
{

    function __construct(UserModel $model, MySQL $connection)
    {
    }

    public function store(array $data): int
    {
        $this->checkFillables($data);

        if (empty($array)) {
            return throw new \Exception("Error: Error storing User in database");
        } else {
            $rows = $this->connection->insert($data, $this->table);
            return $rows;
        }
    }


    public function update(array $data, string|int $id): int
    {
        $this->checkFillables($data);

        if (empty($array)) {
            return throw new \Exception("Error: Error storing User in database");
        } else {
            $where = ["id" => $id];
            $rows = $this->connection->update($data, $where, $this->table);
            return $rows;
        }
    }

    public function delete(string|int $id)
    {
        $this->connection->delete($this->table, [$this->primary_key => $id]);
    }

    private function checkFillables(array $data): bool
    {
        foreach ($data as $dataKeys => $dataValues) {
            if (!in_array($dataKeys, $this->fillable)) {
                return false;
            }
        }
        return throw new \Exception("Error: One or more field does not exist in the database");
    }
}
