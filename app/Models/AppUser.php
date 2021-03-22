<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    use HasFactory;

    public $id;

    public $login;

    public $password;

    public $name;

    public $email;

    public function getTable()
    {
        return 'users';
    }
}
