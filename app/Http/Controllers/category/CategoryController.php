<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryAll()
    {
        $allCat = Category::latest()->get();
        return view('backend.category.all-category',['allData'=>$allCat]);
    }

    public function categoryStore(Request $request)
    {
        Category::categoryStore($request);
        return redirect()->back()->with('massage','Save successfully');
    }

    public function categoryEdit($id)
    {
        $data = Category::find($id);
        return response()->json($data);
    }
}
