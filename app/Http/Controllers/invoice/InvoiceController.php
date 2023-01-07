<?php

namespace App\Http\Controllers\invoice;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function InvoiceAll()
    {

        $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->get();
        return view('backend.invoice.all-invoice',['allData'=>$allData]);
    }
}
