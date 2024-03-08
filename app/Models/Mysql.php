<?php

class Mysql
{
    private $db;

    public function __construct()
    {
        $this->db = new \PDO("mysql:host=;dbname=test", "root", "senha");
    }
}