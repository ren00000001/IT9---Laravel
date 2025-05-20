<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

     protected $primaryKey = 'order_id';

     protected $fillable = [
        'order_date',
        'total',
        'user_id',
        'customer_count',
        'payment_method',
        'cash_amount',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

     public static function createFromPos(array $receiptItems, string $paymentMethod, int $employeeId)
    {
        $order = self::create([
            'order_date' => now(),
            'total' => collect($receiptItems)->sum('total'),
            'employee_id' => $employeeId,
            'customer_count' => 1, 
            'payment_method' => $paymentMethod
        ]);

        foreach ($receiptItems as $item) {
            $order->items()->create([
                'product_id' => $item['productId'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'total_amount' => $item['total']
            ]);
        }

        return $order;
    }
}
