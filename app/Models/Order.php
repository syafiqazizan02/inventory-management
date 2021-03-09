<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 'sub_total', 'discount', 'total', 'amount', 'balance', 'method', 'order_date', 'order_month', 'order_year'
    ];
}
