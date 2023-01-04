<?php

namespace App\Http\Controllers\ajax;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getCategory(Request $request)
    {
        $s_id = $request->id;
        $category = Product::with(['category'])->select('category_id')->where('supplier_id',$s_id)->groupBy('category_id')->get();
       return response()->json($category);
    }
}
