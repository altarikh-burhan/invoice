<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Province;
use App\Models\District;
use App\Models\City;
use DB;

class CustomerController extends Controller
{
    public function index() 
    {
        $customer = Customer::orderBy('created_at', 'DESC')->paginate(10);
        return view('customer.index', [
            'customers' => $customer,
        ]);
    }

    public function create()
    {
        $provinces = Province::orderBy('created_at', 'DESC')->get();
        $cities = City::orderBy('created_at', 'DESC')->get();
        $districts = District::orderBy('name', 'ASC')->get();
        return view('customer.create', compact('provinces', 'cities', 'districts'));
    }

    public function store(Request $request) 
    {
        $attr = $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'max:13'],
            'address' => ['required','string'],
            'province' => ['required','exists:provinces,id'],
            'city' => ['required', 'exists:cities,id'],
            'district' => ['required', 'exists:districts,id']
        ]);
        
        $customer = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'district_id' => $request->district
        ]);
        return redirect()->route('customer')->with('message', 'Customer baru telah ditambahkan');   
    }   

    public function edit($customer) 
    {
        return view('customer.edit', [
            'customer' => Customer::find($customer),
        ]);
    }

    public function update(Request $request, $customer)
    {
        $attr = $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'max:13'],
            'address' => ['required','string'],
        ]);

        try{
            Customer::where('id', $customer)
                    ->update($attr);
            return redirect()->route('customer')->with('message', 'Customer telah diperbaharui');    
        } catch(\Exception $e) {
            return redirect()->route('customer.edit')->with('error', $e->getMessage());
        }
    }

    public function destroy($customer)
    {
        Customer::destroy($customer);
        return redirect()->route('customer')->with('message', 'Customer telah dihapus');
    }

    public function example()
    {
        return view('customer.example');
    }

    public function getCity(Request $request)
    {
        $cities = DB::table("cities")
         ->where("province_id",$request->province_id)
         ->pluck("name","id");
         return response()->json($cities);
 
    }

    public function getDistrict()
    {
        $districts = District::where('city_id', request()->city_id)->get();
        return response()->json(['status' => 'success', 'data' => $districts]);
    }
    
}
