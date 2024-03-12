<?php

namespace App\Models\User;

use App\Models\Model;
use Database\MySQL\MySQL;

class UserModel extends Model
{

    protected MySQL $connection;
    protected string $table = "users";
    protected string $primary_key = "id";

    protected $fillable = [
        'name',
        'email',
        'password'
    ];
}
