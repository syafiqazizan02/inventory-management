<?php

namespace App\Http\Controllers\API\Pos;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use DB;

class PosController extends Controller
{
    public function GetProduct($id)
    {
        $product = Product::where('category_id',$id)->get();

        return response()->json($product);
    }

    public function OrderComplete(Request $request)
    {
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['sub_total'] = $request->subtotal;
        $data['discount'] = $request->discount;
        $data['total'] = $request->total;
        $data['pay_amount'] = $request->pay_amount;
        $data['pay_balance'] = $request->pay_balance;
        $data['pay_method'] = $request->pay_method;
        $data['order_date'] = Carbon::now()->toDateTimeString();
        $data['order_month'] = date('F');
        $data['order_year'] = date('Y');

//        dd($data);

        $order_id = Order::insertGetId($data);

        $carts = Cart::get();

        $detail = array();
        foreach ($carts as $cart) {
            $detail['order_id'] = $order_id;
            $detail['pro_id'] = $cart->pro_id;
            $detail['pro_quantity'] = $cart->pro_quantity;
            $detail['pro_price'] = $cart->pro_price;
            $detail['sub_total'] = $cart->sub_total;

            OrderDetail::insert($detail);

            DB::table('products')
                ->where('id', $cart->pro_id)
                ->update(['product_quantity' => DB::raw('product_quantity -' . $cart->pro_quantity)]);
        }

        DB::table('carts')->delete();

    }


}
