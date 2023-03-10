<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function categoryStore($request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->created_by = Auth::user()->id;
        $category->save();
    }

    public static function categoryUpdate($request)
    {
        $id = $request->upid;
        $category = Category::find($id);
        $category->name = $request->name;
        $category->status = $request->status;
        $category->updated_by = Auth::user()->id;
        $category->save();
    }
}
