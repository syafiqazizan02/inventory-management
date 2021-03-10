<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use DateTime;

class OrderController extends Controller
{
    public function OrderViews(){

        $date = date('Y-m-d');

        $order = Order::join('customers','orders.customer_id','customers.id')
            ->where('order_date', 'LIKE', "%{$date}%")
            ->select('customers.name','orders.*')
            ->orderBy('orders.id','DESC')->get();

        return response()->json($order);
    }

    public function OrderInfos($id)
    {
        $order = Order::join('customers','orders.customer_id','customers.id')
            ->where('orders.id',$id)
            ->select('customers.name','customers.phone','customers.address','orders.*')
            ->first();

        return response()->json($order);
    }

    public function OrderDetails($id)
    {
        $details = OrderDetail::join('products','order_details.pro_id','products.id')
            ->where('order_details.order_id',$id)
            ->select('products.product_name','products.product_code','products.product_image','order_details.*')
            ->get();

        return response()->json($details);
    }

    public function SearchOrderDate(Request $request)
    {
        $orderdate = $request->date;
        $newdate = new DateTime($orderdate);
        $date = $newdate->format('Y-m-d');

        $order = Order::join('customers','orders.customer_id','customers.id')
            ->select('customers.name','orders.*')
             ->where('orders.order_date', 'LIKE', "%{$date}%")
            ->get();

        return response()->json($order);
    }



}
