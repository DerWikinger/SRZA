<?php

namespace App\Models\Dictionaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoltageClass extends Model
{
    use HasFactory;

    protected $table = 'voltage-class';

    protected $fillable = [
        'name',
        'order_index',
    ];
}
