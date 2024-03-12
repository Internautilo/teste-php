<?php

namespace Database;

use Database\Interfaces\DatabaseRetriever;
use Database\Interfaces\DatabaseWriter;

abstract class Database implements DatabaseWriter, DatabaseRetriever
{
    protected \PDO $pdo;

    //Params for the construct method
    protected string $dsn;
    protected string $db_username;
    protected string $db_password;

    //Writer Abstract Functions
    abstract public function insert(array $data, string $intoTable): int;
    abstract public function update(array $data, array $where, string $table): int;
    abstract public function delete(string $table, array $where): int;

    //Retriever Abstract Functions
    abstract public function fetchAll(string $table): array;
    abstract public function findOne(string $table, array $where): array;
}
