<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'user_id', 'amount', 'status','course_id', 'bank_tran_id', 'card_issuer', 'tran_date', 'details'];

    // Generate a unique Order ID
    public static function generateOrderId()
    {
        do {
            $orderId = strtoupper(Str::random(10)); // e.g., A1B2C3D4E5
        } while (self::where('order_id', $orderId)->exists());

        return $orderId;
    }
}
