<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;

class ExampleController extends Controller
{
     public function index() 
    {
        $provinces = Province::orderBy('created_at', 'DESC')->get();
        return view('example.create', compact('provinces'));
    }

     public function getCity(Request $request)
    {
        $cities = DB::table("cities")
         ->where("province_id",$request->province_id)
         ->pluck("name","id");
         return response()->json($cities);
 
    }
}
