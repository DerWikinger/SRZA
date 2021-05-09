<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthrizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Notifications\Notifiable;

class User extends Model implements
    AuthenticatableContract,
    AuthrizableContract,
    MustVerifyEmailContract
{
    use Notifiable;
    use HasFactory;
    use Authenticatable;
    use Authorizable;
    use MustVerifyEmail;
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'nickname',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'role_id',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getUsernameAttribute()
    {
        return $this->nickname ? $this->nickname : $this->name;
    }
}
