<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use PDF;

class InvoiceController extends Controller
{
    public function index()
    {
       $invoice = Invoice::orderBy('created_at', 'DESC')->paginate(10);
        return view('invoice.index', [
            'invoice' => $invoice,
        ]);
    }

    public function create(Request $request)
    {
        return view('invoice.create', [
            'customers' => Customer::orderBy('created_at', 'DESC')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => ['required', 'exists:customers,id']
        ]);

        try {
            $invoice = Invoice::create([
                'customer_id' => $request->customer_id,
                'total' => 0
            ]);
            return redirect()->route('invoice.edit', ['id' => $invoice->id]);
        }catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $invoice = Invoice::with(['customer', 'detail', 'detail.product'])->find($id);
        $products = Product::orderBy('title', 'ASC')->get();
        return view('invoice.edit', [
            'invoice' => $invoice,
            'products' => $products
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'qty' => ['required', 'integer'],
        ]);
        try {
            $invoice = Invoice::find($id);
            $product = Product::find($request->product_id);
            $invoice_detail = $invoice->detail()->where('product_id', $product->id)->first();
            //Jika Datanya ada
            if ($invoice_detail)
            {
                $invoice_detail->update([
                    'qty' => $invoice_detail->qty + $request->qty
                ]);
            } else {
                //Jika tidak ada data
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $request->product_id,
                    'price' => $product->price,
                    'qty' => $request->qty
                ]);
            }
            return redirect()->back()->with('success', "Produk telah ditambahkan");
        } catch(\Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
    public function deleteProduct($id)
    {
        $detail = InvoiceDetail::find($id);
        try{
            $detail->delete();
            return redirect()->back()->with(['success' => 'Product telah dihapus']);     
        } catch(\Exception $e) {
             return redirect()->back()->with('message', $e->getMessage());
        }
    }  

    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();
        return redirect()->back()->with('message', 'Data telah dihapus');
    }

    public function generateInvoice($id)
    {
        $invoice = Invoice::with(['customer', 'detail', 'detail.product'])->find($id);
        $pdf = PDF::loadView('invoice.print', compact('invoice'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
