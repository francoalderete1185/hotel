<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Room extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'description',
        'short_description',
        'capacity',
        'size_m2',
        'price_per_night',
        'icon',
        'image_url',
        'features',
        'is_active',
        'total_units',
    ];

    protected $casts = [
        'features'        => 'array',
        'is_active'       => 'boolean',
        'price_per_night' => 'decimal:2',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(RoomImage::class)->orderBy('order');
    }

    public function primaryImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                $primary = $this->images->firstWhere('is_primary', true)
                    ?? $this->images->first();

                if ($primary) {
                    return '/' . $primary->path;
                }

                return $this->image_url;
            }
        );
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAvailableBetween($query, string $checkIn, string $checkOut)
    {
        return $query->whereRaw(
            '(SELECT COUNT(*) FROM reservations
              WHERE reservations.room_id = rooms.id
                AND reservations.status IN (\'pending\', \'confirmed\')
                AND reservations.check_in  < ?
                AND reservations.check_out > ?) < rooms.total_units',
            [$checkOut, $checkIn]
        );
    }

    public function availableUnitsBetween(string $checkIn, string $checkOut, bool $lock = false): int
    {
        $query = $this->reservations()
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('check_in', '<', $checkOut)
            ->where('check_out', '>', $checkIn);

        if ($lock) {
            $query->lockForUpdate();
        }

        return max(0, $this->total_units - $query->count());
    }
}
