<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function supplierStore($request)
    {
        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->status = $request->status;
        $supplier->created_by = Auth::user()->id;
        $supplier->save();
    }

    public static function supplierUpdate($request)
    {
        $id =  $request->id;
        $supplier = Supplier::find($id);

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->status = $request->statuse;
        $supplier->updated_by = Auth::user()->id;
        $supplier->save();
    }
}
