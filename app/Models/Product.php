<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function productStore($request)
    {
        $product = new Product();
        $product->supplier_id = $request->addsupplier;
        $product->category_id = $request->addcategory;
        $product->unit_id = $request->addunit;
        $product->name = $request->name;
        $product->quantity = '0';
        $product->status = $request->status;
        $product->created_by = Auth::user()->id;
        $product->save();
    }

    public static function productUpdate($request)
    {
        $id = $request->upid;
        $product = Product::find($id);
        $product->supplier_id = $request->editsupplier;
        $product->category_id = $request->editcategory;
        $product->unit_id = $request->editunit;
        $product->name = $request->name;
        $product->quantity = '0';
        $product->status = $request->status;
        $product->updated_by = Auth::user()->id;
        $product->save();
    }


    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class,'unit_id','id');
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class,'product_id','id');
    }

}
