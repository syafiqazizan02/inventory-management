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
        $product = Product::where('category_id', $id)->get();

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


    public function TodaySales()
    {
        $date = date('Y-m-d');
        $sales = DB::table('orders')
            ->where('order_date', 'LIKE', "%{$date}%")
            ->sum('total');

        return response()->json($sales);
    }

    public function TodayIncome()
    {
        $date = date('Y-m-d');
        $income = DB::table('orders')
            ->where('order_date', 'LIKE', "%{$date}%")
            ->sum('pay_amount');

        return response()->json($income);
    }

    public function TodayDue()
    {
        $date = date('Y-m-d');
        $due = DB::table('orders')
            ->where('order_date', 'LIKE', "%{$date}%")
            ->sum('pay_balance');

        return response()->json($due);
    }

    public function TodayExpense()
    {
        $date = date('Y-m-d');
        $expense = DB::table('expenses')
            ->where('expense_date', 'LIKE', "%{$date}%")
            ->sum('amount');

        return response()->json($expense);
    }

    public function StockOut()
    {
        $product = DB::table('products')
            ->where('product_quantity', '<', '1')
            ->get();

        return response()->json($product);
    }
}
