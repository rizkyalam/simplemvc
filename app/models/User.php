<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primary_key = 'user_id';
    protected $fillable = [
        'username', 'password'
    ];
}
