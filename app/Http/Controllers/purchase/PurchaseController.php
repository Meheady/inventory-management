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

    public function purchaseStore(Request $request)
    {
        if ($request->category_id == null){
            return redirect()->back()->with('error','Sorry! You do not select any category.');
        }else{
            Purchase::purchaseStore($request);
            return redirect()->route('purchase.all')->with('massage','Purchase Successfully Complete');
        }

    }
    public function purchaseDelete($id)
    {
        $purchase = Purchase::find($id);
        $purchase->delete();
        return response()->json($purchase);
    }

    public function purchaseApprove()
    {
        $allData = Purchase::where('status',0)->orderBy('id','desc')->orderBy('date','desc')->get();
        return view('backend.purchase.approve-purchase',['allData'=>$allData]);
    }
}
