<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Unit extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function unitStore($request)
    {
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->status = $request->status;
        $unit->created_by = Auth::user()->id;
        $unit->save();
    }
    public static function unitUpdate($request)
    {
        $id = $request->id;
        $unit = Unit::find($id);
        $unit->name = $request->name;
        $unit->status = $request->status;
        $unit->updated_by = Auth::user()->id;
        $unit->save();
    }
}
