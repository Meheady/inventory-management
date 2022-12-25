<?php

namespace App\Http\Controllers\supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
class SupplierController extends Controller
{
    public function supplierAll()
    {
        $allData = Supplier::latest()->get();
        return view('backend.supplier.all-supplier',['allData'=>$allData]);
    }
}
