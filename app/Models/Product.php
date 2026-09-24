<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'sku', 'name', 'description', 'price', 'stock', 'image', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stockLogs()
    {
        return $this->hasMany(StockLog::class);
    }

    /**
     * Adjust stock and write an audit trail entry.
     * $qty positive = stock in, negative = stock out.
     */
    public function adjustStock(int $qty, string $type, ?int $userId = null, ?string $note = null): void
    {
        $this->stock = max(0, $this->stock + $qty);
        $this->save();

        $this->stockLogs()->create([
            'user_id' => $userId,
            'type' => $type,
            'qty' => $qty,
            'stock_after' => $this->stock,
            'note' => $note,
        ]);
    }
}
