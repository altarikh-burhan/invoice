<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Province;
use App\Models\District;
use App\Models\City;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;

class CustomerController extends Controller
{
    public function index() 
    {
        $customer = Customer::with('district')->orderBy('created_at', 'DESC')->paginate(10);
        $product = Product::paginate(10);
        return view('customer.index', [
            'customers' => $customer,
            'products' => $product
        ]);
    }

    public function create()
    {
        $provinces = Province::orderBy('created_at', 'DESC')->get();
        return view('customer.create', compact('provinces'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'max:13'],
            'address' => ['required','string'],
            'province_id' => ['required','exists:provinces,id'],
            'city_id' => ['required','exists:cities,id'],
            'district_id' => ['required','exists:districts,id']
        ]);
        
        $customer = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'district_id' => $request->district_id
        ]);
        try{
            return redirect()->route('customer')->with('message', 'Customer baru telah ditambahkan');   
        }catch(\Exception $e){
            return redirect()->route('customer')->with('error', $e->getMessage());
        }
        
    }   

    public function edit($customer) 
    {
        $provinces = Province::orderBy('created_at', 'DESC')->get();
        $customer = Customer::find($customer);
        return view('customer.edit', [
            'customer' => $customer,
            'provinces' => $provinces,
        ]);
    }

    public function update(Request $request, $customer)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'max:13'],
            'address' => ['required','string'],
            'province_id' => ['required','exists:provinces,id'],
            'city_id' => ['required','exists:cities,id'],
            'district_id' => ['required','exists:districts,id']
        ]);

        try{
            Customer::where('id', $customer)
                    ->update([
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'district_id' => $request->district_id
                    ]);
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
