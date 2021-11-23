<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() 
    {
        $product = Product::all();
        return view('product.index', [
            'products' => $product,
        ]);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $product = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'price' => ['required', 'integer'],
            'stock' => ['required', 'integer'],
        ]);
        
        try{
            if($request->description == null) {
                Product::create([
                    'title' => $request->title,
                    'price' => $request->price,
                    'stock' => $request->stock,
                    'description' => 'Data ini belum memiliki deskripsi'
                ]);    
            } else {
                Product::create([
                    'title' => $request->title,
                    'price' => $request->price,
                    'stock' => $request->stock,
                    'description' => $request->description
                ]);    
            }
            return redirect()->route('product')->with('message', 'Product created successfully!');
        } catch(\Exception $e) {
            return redirect()->route('product.create')->with('error', $e->getMessage());
        }
        
    }

    public function edit($product) 
    {
        $product = Product::find($product);
        return view('product.edit', [
            'products' => $product,
        ]);
    }

    public function update(Request $request, $product)
    {
        $attr = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'stock' => ['required', 'integer'],
        ]);

        Product::where('id', $product)
                ->update($attr);
        return redirect()->route('product')->with('message', 'Produk telah diperbaharui');
    }

    public function destroy($product)
    {
        Product::find($product)->delete();
        $notification = array(
                'message' => 'Post deleted successfully!',
                'alert-type' => 'success'
            );
        return redirect()->route('product')->with($notification);
    }
}
