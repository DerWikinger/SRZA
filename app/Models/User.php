<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthrizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements
    AuthenticatableContract,
    AuthrizableContract
{
    use HasFactory;
    use Authenticatable;
    use Authorizable;

    protected $table = 'users';

    protected $fillable = [
      'name',
      'email',
      'nickname',
      'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
