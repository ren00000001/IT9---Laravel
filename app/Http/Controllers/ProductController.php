<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'inventory'])->get();
        $categories = Category::all();

        return view('TurboParts.Staff.Products', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:50',
            'category_id' => 'nullable|exists:categories,category_id',
            'product_price' => 'required|numeric|min:0',
            'product_status' => 'nullable|boolean',
            'product_description' => 'nullable|string',
        ]);

        $product = Product::create($validated);
        return redirect()->route('staff.products.index')->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return response()->json([
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,category_id',
            'product_price' => 'required|numeric|min:0',
            'product_status' => 'nullable|boolean',
            'product_description' => 'nullable|string',
        ]);

        $product->update($validated);
        return redirect()->route('staff.products.index')->with('success', 'Product updated successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('staff.products.index')->with('success', 'Product deleted successfully!');    
    }

}
