<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'supplier_id', 'product_name', 'product_code', 'product_image', 'product_quantity', 'product_stock', 'product_status', 'buying_price', 'selling_price', 'buying_date', 'selling_date'
    ];
}
