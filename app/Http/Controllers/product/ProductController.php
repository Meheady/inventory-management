<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productAll()
    {
        $allProduct = Product::latest()->get();
        return view('backend.product.all-product',['allData'=>$allProduct]);
    }

    public function productAdd()
    {
        $supplier = Supplier::all();
        $category = Category::all();
        $unit = Unit::all();
        return response()->json(['supplier'=>$supplier,'category'=>$category,'unit'=>$unit]);
    }

    public function productStore(Request $request)
    {
        Product::productStore($request);
        return redirect()->back()->with('massage',' save successfully');
    }

    public function productEdit($id)
    {
        $data = Product::find($id);
        $supplier = Supplier::all();
        $category = Category::all();
        $unit = Unit::all();

        return response()->json(['supplier'=>$supplier,'category'=>$category,'unit'=>$unit,'id'=>$data]);
    }
}
