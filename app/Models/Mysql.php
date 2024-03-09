<?php

namespace App\Models;

class Mysql
{
    private $db;

    public function __construct()
    {
        $this->db = new \PDO("mysql:host=;dbname=test", "root", "");
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, 1);
    }

    public function fetchAll(string $table)
    {   
        $query = "SELECT * FROM {$table}";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findOne(string $table, mixed $where, mixed $equals)
    {
        $query = "SELECT * FROM {$table} WHERE {$where}='{$equals}'";
        var_dump($query);
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function insert(string $table, array $data)
    {
        $keys = implode(", ", array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $query = "INSERT INTO {$table} ({$keys}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($query); 
        var_dump($stmt);
        $stmt->execute(array_values($data));
        return 1;
    }

    public function update(string $table, array $data, mixed $id)
    {
        $keys = implode(", ", array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $sets = implode(", ", array_map(fn($key) => "$key = ?", array_keys($data)));

        $query = "UPDATE {$table} SET {$sets} WHERE id = ?";
        $stmt = $this->db->prepare($query);
        var_dump($stmt);
        $stmt->execute(array_merge(array_values($data), [$id]));
        return 1;
    }

    public function delete(string $table, mixed $where, mixed $equals)
    {   
        $query = "DELETE FROM {$table} WHERE {$where}='{$equals}'";
        var_dump($query);
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return 1;
    }
}