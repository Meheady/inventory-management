<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
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
}
