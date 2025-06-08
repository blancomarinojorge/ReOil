<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Truck
 *
 * @property int $id
 * @property string $name
 * @property string $license_plate
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read Company $company
*/
class Truck extends Model
{
    /** @use HasFactory<\Database\Factories\TruckFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'license_plate',
    ];

    public function company(): BelongsTo{
        return $this->belongsTo(Company::class);
    }
}
