<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Product;
use Session;

class SubCategoryController extends Controller
{
    public function index(){
        $subcategories = SubCategory::join('productTable', 'subCategory.productId' , '=', 'productTable.id')->select('subCategory.*', 'productTable.productName')->orderBy('productTable.productName', 'asc')->get();
        // dd($subcategories);
        return view('subCategory.index', compact('subcategories'));
    }

    public function add(){
        $products = Product::orderBy('productName', 'asc')->get();
        return view('subCategory.add', compact('products'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'productID' => 'required',
            'subcategoryName' => 'required'
        ], [
            'productID' => 'Product field is required',
            'subcategoryName' => 'Subcategory Name is required'
        ]);
        $subcategoryCreate = SubCategory::create($validated);
        if($subcategoryCreate){
            Session::flash('success', 'Subcategory added successfully');
        }else{
            Session::flash('error', 'Unable to add subcategory');
        }
        return redirect('subcategories');
    }

    public function edit($id){
        $products = Product::orderBy('productName', 'asc')->get();
        $subcategoryEdit = SubCategory::find($id);
        return view('subCategory.edit', compact('subcategoryEdit','products'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'productID' => 'required',
            'subcategoryName' => 'required'
        ], [
            'productID' => 'Product field is required',
            'subcategoryName' => 'Subcategory Name is required'
        ]);
        $subcategory = SubCategory::find($id);
        $subcategoryUpdate = $subcategory->update($validated);
        if($subcategoryUpdate){
            Session::flash('success', 'Subcategory updated successfully');
        }else{
            Session::flash('error', 'Unable to update subcategory');
        }
        return redirect('subcategories');
    }

    public function destroy(Request $request,$id){
        $subcategory = SubCategory::find($id);
        $subcategoryDelete = $subcategory->delete();
        if($subcategoryDelete){
            Session::flash('success', 'Subcategory deleted successfully');
        }else{
            Session::flash('error', 'Unable to delete subcategory');
        }
        return redirect('subcategories');
    }
}
