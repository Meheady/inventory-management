<?php

namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function purchaseAll(){
        $allData = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
        return view('backend.purchase.all-purchase',['allData'=>$allData]);
    }

    public function purchaseNew()
    {
        $supplier = Supplier::all();
        $category = Category::all();
        $product = Product::all();

        return view('backend.purchase.new-purchase',['supplier'=>$supplier,'category'=>$category,'product'=>$product]);

    }
}
