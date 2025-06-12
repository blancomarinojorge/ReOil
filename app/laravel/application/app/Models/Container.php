<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Container
 *
 * @property int $id
 * @property string|null $observations
 * @property int $client_id
 * @property int $container_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property-read \App\Models\Client $client
 * @property-read \App\Models\ContainerType $containerType
 */
class Container extends Model
{
    /** @use HasFactory<\Database\Factories\ContainerFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'observations',
        'client_id',
        'container_type_id',
    ];

    public function containerType(): BelongsTo{
        return $this->belongsTo(ContainerType::class);
    }

    public function client(): BelongsTo{
        return $this->belongsTo(Client::class);
    }
}
