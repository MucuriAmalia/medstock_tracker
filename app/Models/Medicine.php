<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medicine extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'dosage_form',
        'strength',
        'unit',
        'quantity',
        'reorder_level',
        'batch_number',
        'expiry_date',
        'supplier',
        'description',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function isLowStock(): bool
    {
        return $this->quantity <= $this->reorder_level;
    }

    public function isExpired(): bool
    {
        return $this->expiry_date && $this->expiry_date->isPast();
    }

    public function isExpiringSoon(int $days = 30): bool
    {
        if (!$this->expiry_date) {
            return false;
        }

        return !$this->isExpired() && $this->expiry_date->lte(now()->addDays($days));
    }

    public function stockStatus(): string
    {
        if ($this->isExpired()) {
            return 'Expired';
        }

        if ($this->isLowStock()) {
            return 'Low Stock';
        }

        if ($this->isExpiringSoon()) {
            return 'Expiring Soon';
        }

        return 'In Stock';
    }
}