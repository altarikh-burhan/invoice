<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\District

class AddressController extends Controller
{
    public function selectProvince(Request $request)
    {
        $provinces = [];

        if($request->has('q')) {
            $search = $request->q;
            $provinces = Province::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->get();
        } else {
            $provinces = Province::limit(5)->get();
        }
        return response()->json($provinces);
    }

    public function selectCity(Request $request)
    {
        $cities = [];
        $provinceID = $request->provinceID;
        if($request->has('q')) {
            $search = $request->q;
            $cities = City::select("id", "name")
                ->where('province_id', $provinceID)
                ->where('name', 'LIKE', '%$search%')
                ->get();
        } else {
            $cities = City::where('province_id', $provinceID)->limit(10)->get();
        }
        return response()->json($cities);
    }

    public function selectDistrict(Request $request)
    {
        $districts = [];
        $cityID = $request->cityID;
        if($request->has('q')) {
            $search = $request->q;
            $districts = District::select("id", "name")
                ->where('city_id', $cityID)
                ->where('name', 'LIKE', '%$search%')
                ->get();
        } else {
            $districts = District::where('city_id', $cityID)->limit(10)->get();
        }
        return response()->json('districts');
    }
}
