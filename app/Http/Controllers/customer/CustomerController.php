<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\detailsInvoice;
use App\Models\Invoice;
use App\Models\payment;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerAll()
    {
        $allCustomer = Customer::latest()->get();;
        return view('backend.customer.all-customer',['data'=>$allCustomer]);
    }

    public function customerStore(Request $request)
    {
        Customer::customerStore($request);
        return redirect()->back()->with('massage','save successfully');
    }

    public function customerEdit($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
    }

    public function customerDelete($id)
    {
        $customer = Customer::find($id);
        if (file_exists($customer->image)){
            unlink($customer->image);
        }
        $customer->delete();
        return response()->json(['massage'=>'Delete success']);
    }

    public function customerUpdate(Request $request)
    {
        Customer::customerUpdate($request);
        return redirect()->back()->with('massage','Update successfully');
    }

    public function customerCredit()
    {
        $allData = payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('backend.customer.customer-credit',compact('allData'));
    }

    public function customerPaid()
    {
        $allData = payment::where('paid_status','!=','full_due')->get();
        return view('backend.customer.customer-paid',compact('allData'));
    }

    public function customerCreditPdf()
    {
        $allData = payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('backend.pdf.customer-credit-pdf',compact('allData'));
    }

    public function customerPaidPdf()
    {
        $allData = payment::where('paid_status','!=','full_due')->get();
        return view('backend.pdf.customer-credit-pdf',compact('allData'));
    }

    public function customerInvoiceEdit($invoice_id)
    {
        $payment = payment::where('invoice_id',$invoice_id)->first();
        $invoiceDetails = detailsInvoice::where('invoice_id',$payment->invoice_id)->get();
        return view('backend.customer.customer_edit_invoice',compact('payment','invoiceDetails'));
    }

    public function customerInvoiceUpdate(Request $request, $invoice_id)
    {

        if($request->new_paid_amount < $request->paid_amount){
            return redirect()->back()->with('error','Sorry! Paid amount less than total amount');
        }
        else{
            Invoice::updateInvoice($request,$invoice_id);
            return redirect()->route('customer.credit')->with('Success','Invoice update successfully');
        }

    }

    public function customerInvoiceDetailsPdf($invoice_id)
    {
        $payment = payment::where('invoice_id',$invoice_id)->first();
        $paymentDetail = detailsInvoice::where('invoice_id',$payment->invoice_id)->get();
        return view('backend.pdf.customer-invoice-details-pdf',compact('payment','paymentDetail'));
    }
}
