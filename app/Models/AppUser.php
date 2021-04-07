<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    use HasFactory;

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
