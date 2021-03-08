<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'pro_id', 'pro_name', 'pro_quantity', 'pro_price','sub_total',
    ];
}
