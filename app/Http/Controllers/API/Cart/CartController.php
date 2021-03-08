<?php

namespace App\Http\Controllers\API\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {
        // get product info
        $product = Product::where('id',$id)->first();

        // check product in cart
        $check = Cart::where('pro_id',$id)->first();

        if ($check) {
            Cart::where('pro_id',$id)->increment('pro_quantity');

            $product = Cart::where('pro_id',$id)->first();
            $subtotal = $product->pro_quantity * $product->product_price;

            Cart::where('pro_id',$id)->update(['sub_total'=> $subtotal]);
        }else{

            $data = new Cart([
                'pro_id' => $id,
                'pro_name' => $product->product_name,
                'pro_quantity' => 1,
                'product_price' => $product->selling_price,
                'sub_total' => $product->selling_price
            ]);
            $data->save();

            return response($data)->json();
        }

    }



}
