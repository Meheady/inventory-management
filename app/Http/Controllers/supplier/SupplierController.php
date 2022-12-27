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

    public function supplierStore(Request $request)
    {
        Supplier::supplierStore($request);
        return redirect()->back()->with('massage','save successfully');
    }

    public function supplierUpdate(Request $request)
    {
        Supplier::supplierUpdate($request);
        return redirect()->back()->with('massage','Update successfully');
    }

    public function supplierEdit($id)
    {
        $data = Supplier::find($id);
        return response()->json($data);
    }

    public function supplierDelete($id)
    {
        $data = Supplier::find($id);
        $data->delete();
        $allData = Supplier::latest()->get();
        return response()->json($allData);
    }
}
