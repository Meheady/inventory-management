<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerAll()
    {
        $allCustomer = Customer::latest();
        return view('backend.customer.all-customer',['data'=>$allCustomer]);
    }
}
