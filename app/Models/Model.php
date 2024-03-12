<?php

namespace App\Models;

abstract class Model
{
    protected $connection;
    protected string $table;
    protected string $primary_key;
}
