<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryArea extends Model
{
    protected $table = 'delivery_areas';

    protected $fillable = [
        'name',
        'postal_code',
        'delivery_fee',
        'active',
        'sort_order',
    ];

    protected $casts = [
        'delivery_fee' => 'decimal:4',
        'active' => 'boolean',
        'sort_order' => 'integer',
    ];
}