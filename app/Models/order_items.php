<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_items extends Model
{
    protected $fillable = [
        'order_id',
        'food_id',
        'quantity',
        'unit_price',
        'subtotal'
    ];
}
