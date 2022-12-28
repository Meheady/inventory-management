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
        return view('backend.unit.all-unit',['data'=>$allUnit]);
    }

    public function unitStore(Request $request)
    {

    }
    public function unitUpdate(Request $request)
    {

    }
    public function unitEdit($id)
    {

    }
    public function unitDelete($id)
    {

    }
}
