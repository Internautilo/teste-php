<?php

namespace App\Controllers;

use App\Models\User\UserModel;
use Database\MySQL\MySQL;

class UserController extends UserModel
{

    function __construct(UserModel $model, MySQL $connection)
    {
    }
}
