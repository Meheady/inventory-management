<?php

namespace App\Http\Controllers\invoice;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Unit;
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

    public function InvoiceAdd()
    {
        $supplier = Supplier::all();
        $unit = Unit::all();
        $customer = Customer::all();
        $category = Category::all();
        $invoice_data = Invoice::orderBy('id','desc')->first();
        if ($invoice_data == null){
            $inv_no = '0';
            $invoice_no = $inv_no + 1;
        }
        else{
            $invoiceData = Invoice::orderBy('id','desc')->first()->invoice_no;
            $invoice_no = $invoiceData+1;
        }
        return view('backend.invoice.add-invoice',compact('invoice_no','customer','supplier','unit','category'));
    }

    public function InvoiceStore(Request $request)
    {
        if($request->category_id == null){
            return redirect()->back()->with('error','Sorry! You must insert category');
        }else{
            if($request->paid_amount > $request->est_amount){
                return redirect()->back()->with('error','Sorry! Paid amount less than total amount');
            }
        }
    }
}
