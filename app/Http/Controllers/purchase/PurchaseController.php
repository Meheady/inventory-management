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

    public function purchasePending()
    {
        $allData = Purchase::where('status',0)->orderBy('id','desc')->orderBy('date','desc')->get();
        return view('backend.purchase.pending-purchase',['allData'=>$allData]);
    }
    public function purchaseApprove($id){
        $purchase = Purchase::find($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;
        if($product->save()){
            Purchase::find($id)->update([
                'status'=>'1',
            ]);

            return response()->json(['massage'=>'Approve successfully','url'=>'/admin/purchase/all']);
        }
    }

    public function purchaseReportDaily()
    {
        return view('backend.purchase.daily-purchase-report');
    }

    public function purchaseReportDailyPdf(Request $request)
    {
        $sdate = $request->startdate;
        $enddate = $request->enddate;
        $allData = Purchase::whereBetween('date',[$sdate,$enddate])->where('status','1')->get();
        return view('backend.pdf.daily-purchase-pdf',compact('allData','sdate','enddate'));
    }
}
