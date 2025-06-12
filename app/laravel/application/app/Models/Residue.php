<?php

namespace App\Models;

use App\Enums\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Residue
 *
 * @property int $id
 * @property string $name
 * @property Unit $unit
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Company $company
*/
class Residue extends Model
{
    /** @use HasFactory<\Database\Factories\ResidueFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'unit',
    ];

    protected $casts = [
        'unit' => Unit::class,
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
