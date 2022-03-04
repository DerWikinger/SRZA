<?php

namespace App\Models\Dictionaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentClass extends Model
{
    use HasFactory;

    protected $table = 'current-class';

    protected $fillable = [
        'name',
        'order_index',
    ];
}
