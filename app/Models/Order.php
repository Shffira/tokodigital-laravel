<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_code', 'user_id', 'type', 'payment_method', 'status', 'total', 'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateCode(): string
    {
        return 'ORD-' . now()->format('ymd') . '-' . strtoupper(substr(uniqid(), -5));
    }
}
