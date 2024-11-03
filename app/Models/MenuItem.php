<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'available',
        'preparation_time'
    ];

    protected $casts = [
        'available' => 'boolean',
        'price' => 'decimal:2'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }
}
