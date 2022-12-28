<?php

namespace App\Http\Controllers\unit;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function unitAll()
    {
        $allUnit = Unit::latest()->get();
        return view('backend.unit.all-unit',['allData'=>$allUnit]);
    }

    public function unitStore(Request $request)
    {
        Unit::unitStore($request);
        return redirect()->back()->with('massage','Save successfully');
    }
    public function unitUpdate(Request $request)
    {
        Unit::unitUpdate($request);
        return redirect()->back()->with('massage','Update successfully');
    }
    public function unitEdit($id)
    {
        $data = Unit::find($id);
        return response()->json($data);
    }
    public function unitDelete($id)
    {
        $data = Unit::find($id);
        $data->delete();
        return response()->json(['massage'=>'Delete success']);
    }
}
