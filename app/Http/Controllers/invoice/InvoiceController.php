<?php

namespace App\Http\Controllers\invoice;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\detailsInvoice;
use App\Models\payment;
use App\Models\paymentDetail;
use App\Models\Purchase;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function InvoiceAll()
    {
        $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
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
            else{
                Invoice::storeInvoice($request);
                return redirect()->route('invoice.pending')->with('Success','Invoice added successfully');
            }
        }
    }

    public function InvoicePending()
    {
        $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.invoice.pending-invoice',['allData'=>$allData]);
    }

    public function InvoiceDelete($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();
        detailsInvoice::where('invoice_id',$invoice->id)->delete();
        payment::where('invoice_id',$invoice->id)->delete();
        paymentDetail::where('invoice_id',$invoice->id)->delete();
        return response()->json(['massage'=>'Delete successfully','url'=>'/admin/invoice/pending']);
    }

    public function InvoiceApprove($id)
    {
        $invoice = Invoice::with('invoiceDetails')->find($id);
        $payment = payment::where('invoice_id', $id)->first();
        return view('backend.invoice.approve-invoice',compact('invoice','payment'));
    }

    public function InvoiceApproveStore(Request $request,$id)
    {

        foreach ($request->selling_qty as $key => $val){

            $invoice_details  = detailsInvoice::where('id',$key)->first();
            $product = Product::where('id',$invoice_details->product_id)->first();
            if ($product->quantity < $request->selling_qty[$key]){
                return redirect()->back()->with('error','Sorry you approve maximum value');
            }
            $invoice = Invoice::find($id);
            $invoice->updated_by = Auth::user()->id;
            $invoice->status = '1';

            DB::transaction(function() use($request,$invoice,$id){
               foreach ($request->selling_qty as $key =>$val){
                   $invoice_details = detailsInvoice::where('id',$key)->first();
                   $product = Product::where('id',$invoice_details->product_id)->first();
                   $product->quantity = ((float)$product->quantity) - ((float)$request->selling_qty[$key]);
                   $product->save();
               }
               $invoice->save();
            });
            return redirect()->route('invoice.pending')->with('massage','Invoice approve successfully');
        }
    }

    public function InvoicePrint()
    {
        $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
        return view('backend.invoice.print-invoice',['allData'=>$allData]);
    }

    public function printInvoice($id)
    {
        $invoice = Invoice::with('invoiceDetails')->find($id);
        $payment = payment::where('invoice_id', $id)->first();
        return view('backend.pdf.invoice_pdf',compact('invoice','payment'));
    }

    public function dailyInvoiceReport()
    {
        return view('backend.invoice.daily-invoice-report');
    }
}
