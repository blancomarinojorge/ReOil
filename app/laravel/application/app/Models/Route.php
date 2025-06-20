<?php

namespace App\Models;

use App\Enums\RouteState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Route
 *
 * @property int $id
 * @property int $state
 * @property string|null $description
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $started_at
 * @property \Illuminate\Support\Carbon $finished_at
 * @property int $creator_id
 * @property int $driver_id
 * @property int $truck_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property \App\Models\User $creator
 * @property \App\Models\User $driver
 * @property \App\Models\Truck $truck
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\RoutePickup[] $pickups
 */
class Route extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'state',
        'start_date',
        'description',
        'driver_id',
        'creator_id',
        'truck_id'
    ];

    protected $casts = [
        'state' => RouteState::class
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function pickups(): HasMany
    {
        return $this->hasMany(RoutePickup::class);
    }

}
