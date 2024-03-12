<?php

declare(strict_types=1);

namespace Database\MySQL;

use Database\Database;
use Database\DatabaseConnection;

class MySQL extends Database
{
    //PDO Object for dabatase connection
    protected \PDO $pdo;

    //Params for __construct()
    protected string $db_host = "localhost";
    protected string $db_name = "test";
    protected string $db_username = "root";
    protected string $db_password = "";

    public function __construct()
    {
        $numberOfArguments = func_num_args();
        if ($numberOfArguments > 0) {
            $arguments = func_get_args();
            call_user_func_array(array($this, "__construct1"), $arguments);
        } else {
            $this->setDsn();
            $conn = new DatabaseConnection($this->dsn, $this->db_username, $this->db_password);
            $this->pdo = $conn->getConnection();
        }
    }

    //Helper Functions
    public function __construct1(DatabaseConnection $conn)
    {
        $this->pdo = $conn->getConnection();
    }

    private function setDsn()
    {
        $db_host = $this->db_host;
        $db_name = $this->db_name;
        $this->dsn = "mysql:host={$db_host};dbname={$db_name}";
    }

    private static function whereStatement($whereArray): string
    {
        $whereKey = array_keys($whereArray);
        $whereValue = array_values($whereArray);
        $whereStatement = "WHERE {$whereKey[0]}='{$whereValue[0]}'";
        return $whereStatement;
    }

    //Database manipulators
    public function fetchAll(string $table): array
    {
        $query = "SELECT * FROM {$table}";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findOne(string $table, array $where): array
    {
        $query = "SELECT * FROM {$table} " . $this::whereStatement($where);
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function insert(array $data, string $intoTable): int
    {
        $table = $intoTable;
        $keys = implode(", ", array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $query = "INSERT INTO {$table} ({$keys}) VALUES ({$placeholders})";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array_values($data));
        return $stmt->rowCount();
    }

    public function update(array $data, array $where, string $table): int
    {
        $sets = implode(", ", array_map(fn ($key) => "$key = ?", array_keys($data)));

        $query = "UPDATE {$table} SET {$sets} " . $this::whereStatement($where);
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array_merge(array_values($data)));
        return $stmt->rowCount();
    }

    public function delete(string $table, array $where): int
    {
        $query = "DELETE FROM {$table} " . $this::whereStatement($where);
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
