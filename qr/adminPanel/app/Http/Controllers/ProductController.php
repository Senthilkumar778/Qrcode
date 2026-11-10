<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Session;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('productName','asc')->get();

        return view('products.index', compact('products'));
    }

    public function add () {
        return view('products.add');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'productName' => 'required',
            'description' => 'nullable',
            'enquiryFlag' => 'nullable'
        ]);

        $validated['enquiryFlag'] = isset($validated['enquiryFlag']) ? 1 : 0;

        $productCreate = Product::create($validated);
        if($productCreate ){
            Session::flash('success', 'Product Added successfully');
        }else{
            Session::flash('error', 'Unable to add product');
        }
        return redirect('products');
    }

    public function edit($id){
        $productEdit = Product::find($id);
        return view('products.edit', compact('productEdit'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'productName' => 'required',
            'description' => 'nullable',
            'enquiryFlag' => 'nullable'
        ]);

        $validated['enquiryFlag'] = isset($validated['enquiryFlag']) ? 1 : 0;
        $product = Product::find($id);

        $productUpdate = $product->update($validated);
        if($productUpdate){
            Session::flash('success', 'Product updated successfully');
        }else{
            Session::flash('success', 'Unable to update product');
        }
        return redirect('products');
    }

    public function destroy($id){
        $product = Product::find($id);
        $productDelete = $product->delete();
        if($productDelete){
            Session::flash('success', 'Product deleted successfully');
        }else{
            Session::flash('success', 'Unable to delete product');
        }
        return redirect('products');
    }
}
