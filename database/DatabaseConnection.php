<?php

namespace Database;

class DatabaseConnection
{
    protected \PDO $pdo;

    public function __construct(?string $dsn, ?string $username, ?string $password)
    {
        try {
            $this->pdo = new \PDO($dsn, $username, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function getConnection(): \PDO
    {
        return $this->pdo;
    }
}
