<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $fillable = [
        'user_id',
        'order_date',
        'total_amount',
        'status',
        'delivery_address',
    ];
}
