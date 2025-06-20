<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;



/**
 * Class PickupResidueContainer
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $route_pickup_id
 * @property int $residue_id
 * @property int $container_id
 * @property float $quantity
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $pickup_time
 * @property bool $should_pickup_container
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property RoutePickup $pickup
 * @property Residue $residue
 * @property Container $container
 *
 */
class PickupResidueContainer extends Model
{
    /** @use HasFactory<\Database\Factories\PickupResidueContainerFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'pickup_residue_containers';

    protected $fillable = [
        'route_pickup_id',
        'residue_id',
        'container_id',
        'quantity',
        'notes',
        'pickup_time',
        'should_pickup_container',
    ];

    protected $casts = [
        'should_pickup_container' => 'boolean',
        'pickup_time' => 'datetime',
        'quantity' => 'float',
    ];

    public function pickup(): BelongsTo
    {
        return $this->belongsTo(RoutePickup::class,  'route_pickup_id');
    }
    public function residue(): BelongsTo
    {
        return $this->belongsTo(Residue::class);
    }

    public function container(): BelongsTo
    {
        return $this->belongsTo(Container::class);
    }
}
