<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'table_number',
        'customer_name',
        'status',
        'priority',
        'notes',
        'started_at',
        'completed_at'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTimeElapsedAttribute(): string
    {
        if (!$this->started_at) {
            return '0m';
        }

        $endTime = $this->completed_at ?? now();
        $minutes = $endTime->diffInMinutes($this->started_at);

        return "{$minutes}m";
    }
}
