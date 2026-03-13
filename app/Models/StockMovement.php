<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    protected $fillable = [
        'medicine_id',
        'user_id',
        'type',
        'quantity',
        'reference',
        'destination_or_source',
        'notes',
        'movement_date',
    ];

    protected $casts = [
        'movement_date' => 'date',
    ];

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isStockIn(): bool
    {
        return $this->type === 'in';
    }

    public function isStockOut(): bool
    {
        return $this->type === 'out';
    }

    public function isAdjustment(): bool
    {
        return $this->type === 'adjustment';
    }
}