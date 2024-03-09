<?php

namespace App\Models;

class Mysql
{
    private $db;

    public function __construct()
    {
        $this->db = new \PDO("mysql:host=;dbname=test", "root", "");
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

    
}