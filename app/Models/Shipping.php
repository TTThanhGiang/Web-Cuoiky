<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'address',
        'shipping_status',
        'shipped_date',
        'delivered_date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
