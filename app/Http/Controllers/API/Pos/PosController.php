<?php

namespace App\Http\Controllers\API\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
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

    }


}
