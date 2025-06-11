<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $address
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property-read \App\Models\Company $company
*/
class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'latitude_longitude', //I store the latitude and longitude via the mutator, what I receive in the request is the comma separated version
    ];

    public function company(): BelongsTo{
        return $this->belongsTo(Company::class);
    }


   /**
    * Set the latitude and longitude attributes from a single comma-separated string.
    *
    * This allows the model to accept a 'latitude_longitude' field like:
    * "43.0322127, -8.7995312" and automatically store it in separate
    * 'latitude' and 'longitude' columns in the database.
    *
    * @param  string|null  $value  The combined latitude and longitude string.
    */
    public function setLatitudeLongitudeAttribute(?string $value): void
    {
        if ($value && str_contains($value, ',')) {
            list($latitude, $longitude) = explode(',', $value);
            $this->latitude = trim($latitude);
            $this->longitude = trim($longitude);
        }
    }

    public function getLatitudeLongitudeAttribute(): ?string{
        if ($this->latitude && $this->longitude) {
            return $this->latitude . ',' . $this->longitude;
        }
        return null;
    }
}
