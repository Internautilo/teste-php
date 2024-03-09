<?php 

require '../vendor/autoload.php';

use App\Models\Mysql;


$conn = new Mysql;

$data = [
    "name" => "yuri",
    "email" => "yuri@email.com",
    "password" => "senha",
];

$conn->insert("USER", $data);