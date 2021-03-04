<?php

namespace App\Http\Controllers\API\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class PosController extends Controller
{
//    public function GetProducts($id)
//    {
//        $product = Product::where('category_id',$id)->get();
//
//        return response()->json($product);
//    }

    public function GetProduct($id){

        $product = DB::table('products')
            ->where('category_id',$id)
            ->get();
        return response()->json($product);

    }
}
