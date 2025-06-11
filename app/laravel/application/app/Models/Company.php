<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string $cif
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Truck[] $trucks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
*/
class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'nif'
    ];

    public function users(): HasMany{
        return $this->hasMany(User::class);
    }

    public function trucks(): HasMany{
        return $this->hasMany(Truck::class);
    }

    public function clients(): HasMany{
        return $this->hasMany(Client::class);
    }
}
