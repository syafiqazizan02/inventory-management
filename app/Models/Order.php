<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 'sub_total', 'discount', 'total', 'pay_amount', 'pay_balance', 'pay_method', 'order_date', 'order_month', 'order_year'
    ];
}
