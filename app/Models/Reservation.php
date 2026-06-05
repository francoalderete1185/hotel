<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
        'code',
        'room_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'check_in',
        'check_out',
        'guests_count',
        'total_amount',
        'payment_method',
        'status',
    ];

    protected $casts = [
        'check_in'     => 'date',
        'check_out'    => 'date',
        'total_amount' => 'decimal:2',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function nights(): int
    {
        return $this->check_in->diffInDays($this->check_out);
    }
}
