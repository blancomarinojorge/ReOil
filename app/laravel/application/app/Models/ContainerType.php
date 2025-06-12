<?php

namespace App\Models;

use App\Enums\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ContainerType
 *
 * @property int $id
 * @property string $name
 * @property string $unit
 * @property string $capacity
 * @property string|null $un_code
 * @property float|null $length_cm
 * @property float|null $width_cm
 * @property float|null $height_cm
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property-read \App\Models\Company $company
 * @property-read float|null $volume_cm3
*/
class ContainerType extends Model
{
    /** @use HasFactory<\Database\Factories\ContainerTypeFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'unit',
        'capacity',
        'un_code',
        'length_cm',
        'width_cm',
        'height_cm',
    ];

    public function company(): BelongsTo{
        return $this->belongsTo(Company::class);
    }

    protected $casts=[
        'capacity'=>'decimal:2',
        'length_cm'=>'decimal:2',
        'width_cm'=>'decimal:2',
        'height_cm'=>'decimal:2',
        'unit'=>Unit::class,
    ];

    public function getDimensionsAttribute(): string|null{
        if ($this->length_cm && $this->width_cm && $this->height_cm){
            return $this->length_cm . ' x ' . $this->width_cm . ' x ' . $this->height_cm;
        }
        return null;
    }

    /**
     * Calculate volume in cubic centimeters (cm³).
     *
     * @return float|null
     */
    public function getVolumeCm3Attribute(): float|null{
        if ($this->length_cm && $this->width_cm && $this->height_cm){
            return round($this->length_cm * $this->width_cm * $this->height_cm, 2);
        }
        return null;
    }
}
