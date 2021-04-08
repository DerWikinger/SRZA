<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;
    use Authenticatable;

    protected $table = 'users';

    protected $fillable = [
      'name',
      'email',
      'login',
      'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
