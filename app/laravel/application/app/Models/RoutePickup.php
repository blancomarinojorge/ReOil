<?php

namespace App\Models;

use App\Enums\PickupState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\RoutePickup
 *
 * @property int $id
 * @property int $state
 * @property string $delivery_note_notes
 * @property string $observations
 * @property int $order
 * @property array|null $signature
 * @property \Carbon\Carbon|null $start_time
 * @property \Carbon\Carbon|null $end_time
 * @property int $route_id
 * @property int $client_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 *
 * @property-read \App\Models\Client $client
 * @property-read \App\Models\Route $route
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RoutePickup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoutePickup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoutePickup query()
 * @method static \Illuminate\Database\Query\Builder|RoutePickup onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|RoutePickup withTrashed()
 * @method static \Illuminate\Database\Query\Builder|RoutePickup withoutTrashed()
 */
class RoutePickup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'state',
        'delivery_note_notes',
        'observations',
        'order',
        'signature',
        'start_time',
        'end_time',
        'client_id',
    ];

    protected $casts = [
        'signature' => 'array',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'state' => PickupState::class,
    ];

    public function route(): BelongsTo{
        return $this->belongsTo(Route::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
