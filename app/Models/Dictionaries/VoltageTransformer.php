<?php

namespace App\Models\Dictionaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoltageTransformer extends Model
{
    use HasFactory;

    protected $table = 'voltage-transformer';

    protected $fillable = [
        'name',
        'order_index',
    ];
}
