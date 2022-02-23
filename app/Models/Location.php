<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        'name',
        'avatar',
        'description',
    ];

    public function units()
    {
        return $this->hasMany(Unit::class, 'location_id');
    }
}
