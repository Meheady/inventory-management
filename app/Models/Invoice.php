<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function storeInvoice($request)
    {

        $invoice = new Invoice();
        $invoice->invoice_no = $request->invoice_no;
        $invoice->date = date('Y-m-d',strtotime($request->date));
        $invoice->description = $request->description;
        $invoice->status = '0';
        $invoice->created_by = Auth::user()->id;

        DB::transaction(function ()use($request,$invoice){
            if($invoice->save()){
                $countCat = count($request->category_id);
                for ($i = 0; $countCat > $i; $i++){
                    $invoiceDetails = new detailsInvoice();
                    $invoiceDetails->date = date('Y-m-d',strtotime($request->date));
                    $invoiceDetails->invoice_id = $invoice->id;
                    $invoiceDetails->category_id = $request->category_id[$i];
                    $invoiceDetails->product_id = $request->product_id[$i];
                    $invoiceDetails->selling_qty = $request->sell_qty[$i];
                    $invoiceDetails->unit_price = $request->unit_price[$i];
                    $invoiceDetails->selling_price = $request->selling_price[$i];
                    $invoiceDetails->status = '1';
                    $invoiceDetails->generate_by = Auth::user()->id;
                    $invoiceDetails->save();
                }
                if ($request->customer == 'new_customer'){
                    $customer = new  Customer();
                    $customer->name = $request->name;
                    $customer->email = $request->email;
                    $customer->phone = $request->phone;
                    $customer->save();
                    $customer_id = $customer->id;
                }
                else{
                    $customer_id = $request->customer;
                }
                $payment = new payment();
                $paymentDetails = new paymentDetail();
                $payment->invoice_id = $invoice->id;
                $payment->customer_id = $customer_id;
                $payment->paid_status = $request->paid_status;
                $payment->total_amount = $request->est_amount;
                $payment->discount_amount = $request->discount;
                if($request->paid_status == 'full_paid'){
                    $payment->paid_amount =  $request->est_amount;
                    $payment->due_amount = '0';
                    $paymentDetails->current_paid_amount =  $request->est_amount;
                }
                elseif ($request->paid_status == 'full_due'){
                    $payment->paid_amount = '0';
                    $payment->due_amount = $request->est_amount;
                    $paymentDetails->current_paid_amount =  '0';
                }
                elseif ($request->paid_status == 'partial_paid'){
                    $payment->paid_amount = $request->paid_amount;
                    $payment->due_amount = $request->est_amount - $request->paid_amount;
                    $paymentDetails->current_paid_amount =  $request->paid_amount;
                }
                $payment->save();
                $paymentDetails->invoice_id = $invoice->id;
                $paymentDetails->date = date('Y-m-d',strtotime($request->date));
                $paymentDetails->save();
            }
        });
    }

    public static function updateInvoice($request, $id)
    {
        $payment = payment::where('invoice_id',$id)->first();
        $paymentDetail = new paymentDetail();

        DB::transaction(function ()use($request,$id,$payment,$paymentDetail){
            $payment->paid_status = $request->paid_status;

            if ($request->paid_status == 'full_paid'){
                $payment->paid_amount = $payment->paid_amount + $request->new_paid_amount;
                $payment->due_amount = '0';
                $paymentDetail->current_paid_amount = $request->new_paid_amount;
            }
            else if ($request->paid_status == 'partial_paid'){
                $payment->paid_amount = $payment->paid_amount + $request->paid_amount;
                $payment->due_amount = $payment->due_amount - $payment->paid_amount;
                $paymentDetail->current_paid_amount = $payment->paid_amount;
            }

            $payment->save();

            $paymentDetail->invoice_id = $id;
            $paymentDetail->date = date('Y-m-d',strtotime($request->date));
            $paymentDetail->update_by = Auth::user()->id;
            $paymentDetail->save();
        });
    }

    public function payment()
    {
        return $this->belongsTo(payment::class,'id','invoice_id');
    }

    public function invoiceDetails()
    {
        return $this->hasMany(detailsInvoice::class,'invoice_id','id');
    }
}
