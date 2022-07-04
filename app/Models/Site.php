<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $table = 'sites';

    public function parent()
    {
        return $this->belongsTo(Site::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Site::class, 'parent_id', 'id');
    }
}
