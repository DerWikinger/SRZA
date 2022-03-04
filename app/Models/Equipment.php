<?php

namespace App\Models;

use App\Models\Dictionaries\CurrentClass;
use App\Models\Dictionaries\CurrentTransformer;
use App\Models\Dictionaries\EquipmentType;
use App\Models\Dictionaries\VoltageClass;
use App\Models\Dictionaries\VoltageTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use function PHPUnit\Framework\throwException;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';

    protected $fillable = [
        'name',
        'avatar',
        'number',
        'mark',
        'model',
        'schema_label',
        'production_date',
        'description',
    ];

    public function cell()
    {
        return $this->belongsTo(Cell::class, 'cell_id');
    }

    public function equipmentType()
    {
        return $this->belongsTo(EquipmentType::class, 'equipment_type');
    }

    public function voltage()
    {
        return $this->belongsTo(VoltageClass::class, 'voltage_class');
    }

    public function current()
    {
        return $this->belongsTo(CurrentClass::class, 'current_class');
    }

    public function transformRatio()
    {
        if($this->equipmentType() && $this->equipmentType->id == 11) // Voltage transformer
        {
            return $this->belongsTo(VoltageTransformer::class, 'ratio');
        }
        else if($this->equipmentType() && $this->equipmentType->id == 12) // Current transformer
        {
            return $this->belongsTo(CurrentTransformer::class, 'ratio');
        }
        else {
            return  null;
        }
    }
}
