<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static $getImgExt;
    public static $imgName;
    public static $location;
    public static $imgUrl;
    public static function uploadImg($image)
    {
        self::$getImgExt = $image->getClientOriginalExtension();
        self::$imgName = time().'.'.self::$getImgExt;
        self::$location = "images/customer/";
        $image->move(self::$location,self::$imgName);
       return self::$imgUrl = self::$location.self::$imgName;
    }

    public static function customerStore($request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->status = $request->status;
        $customer->image = self::uploadImg($request->file('image'));
        $customer->created_by = Auth::user()->id;
        $customer->save();
    }

    public static function customerUpdate($request,$getUpId)
    {
        $id = $request->id;
        $customer = Customer::find($id);
        if ($request->file('image')){
            if (file_exists($customer->image)){
                unlink($customer->image);
            }
            self::$imgUrl = self::uploadImg($request->file('image'));
        }
        else {
            self::$imgUrl = $customer->image;
        }
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->status = $request->status;
        $customer->image = self::$imgUrl;
        $customer->created_by = Auth::user()->id;
        $customer->save();

    }
}
