<?php

namespace App\Http\Controllers\stock;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
}
