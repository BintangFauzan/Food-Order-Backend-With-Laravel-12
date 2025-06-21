<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class foods extends Model
{
    //
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image_url',
        'is_available'
    ];

    protected function image()
    {
        return Attribute::make(
            get: fn ($image) => url('storage/foods/' . $image),
        );
    }
}
