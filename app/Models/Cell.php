<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;

    protected $table = 'cells';

    protected $fillable = [
        'number',
        'name',
        'avatar',
        'description',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function equipments()
    {
        return $this->hasMany(Equipment::class, 'cell_id');
    }
}
