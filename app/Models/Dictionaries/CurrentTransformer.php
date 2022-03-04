<?php

namespace App\Models\Dictionaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentTransformer extends Model
{
    use HasFactory;

    protected $table = 'current-transformer';

    protected $fillable = [
        'name',
        'order_index',
    ];
}
