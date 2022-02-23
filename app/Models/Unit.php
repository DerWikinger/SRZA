<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';

    protected $fillable = [
        'name',
        'avatar',
        'description',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
