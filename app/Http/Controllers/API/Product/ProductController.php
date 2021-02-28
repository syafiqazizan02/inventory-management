<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Image;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('products')
            ->join('categories','products.category_id','categories.id')
            ->join('suppliers','products.supplier_id','suppliers.id')
            ->select('categories.category_name','suppliers.name','products.*')
//            ->orderBy('products.id','DESC')
            ->get();

        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'product_quantity' => 'required',
            'product_stock' => 'required'
        ]);

        if ($request->product_image) {
            $position = strpos($request->product_image, ';');
            $sub = substr($request->product_image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->product_image)->resize(240,200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $img->save($image_url);


            $product = new Product;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->selling_date = $request->selling_date;
            $product->product_stock = $request->product_stock;
            $product->product_quantity = $request->product_quantity;
            $product->product_status = 0;
            $product->product_image = $image_url;
            $product->save();
        }else{
            $product = new Product;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->selling_date = $request->selling_date;
            $product->product_stock = $request->product_stock;
            $product->product_quantity = $request->product_quantity;
            $product->product_status = 0;
            $product->save();
        }

        return response()->json($product);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id',$id)->first();

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_name' => 'required|max:255',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'product_quantity' => 'required',
            'product_stock' => 'required'
        ]);

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['supplier_id'] = $request->supplier_id;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        //$data['buying_date'] = $request->buying_date;
        //$data['selling_date'] = $request->selling_date;
        $data['product_stock'] = $request->product_stock;
        $data['product_quantity'] = $request->product_quantity;
        $image = $request->newimage;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($image)->resize(240,200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $success = $img->save($image_url);

            if ($success) {
                $data['product_image'] = $image_url;
                $img = Product::where('id',$id)->first();
                $image_path = $img->product_image;
//                $done = unlink($image_path);
                $user  = Product::where('id',$id)->update($data);
            }

        }else{
            $oldphoto = $request->product_image;
            $data['product_image'] = $oldphoto;
            $user = Product::where('id',$id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id',$id)->first();
        $photo = $product->product_image;

        if ($photo) {
            unlink($photo);
            Product::where('id',$id)->delete();
        }else{
            Product::where('id',$id)->delete();
        }
    }
}
