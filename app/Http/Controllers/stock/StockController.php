<?php

namespace App\Http\Controllers\stock;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stockReport()
    {
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('backend.stock.stock-report',compact('allData'));
    }

    public function stockReportPdf()
    {
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('backend.pdf.stock-report-pdf',compact('allData'));
    }

    public function stockSupplier()
    {
        $supplier = Supplier::all();
        $category = Category::all();
      return view('backend.stock.supplier-stock',compact('supplier','category'));
    }

    public function stockSupplierPdf(Request $request)
    {
        $supplierId =  $request->supplier_name;
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->where('supplier_id',$supplierId)->get();
        return view('backend.pdf.stock-supplier-report-pdf',compact('allData'));
    }
}
