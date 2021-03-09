<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function OrderViews(){

        $date = date('Y-m-d');

        $order = Order::join('customers','orders.customer_id','customers.id')
            // ->where('order_date',$date)
            ->where('order_date', 'LIKE', "%{$date}%")
            ->select('customers.name','orders.*')
            ->orderBy('orders.id','DESC')->get();

        return response()->json($order);
    }



}
