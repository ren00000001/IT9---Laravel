<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'inventory'])->get();
        $categories = Category::all();
        $lowStockProducts = Product::whereHas('inventory', function($query){
            $query->where('stocks_quantity', '<', 10);
        })->with('inventory')->get();

        return view('TurboParts.Staff.Products', compact('products', 'categories', 'lowStockProducts'));
    }

    public function lowStock($threshold = 10)
    {
        return view('TurboParts.Staff.Products', [
            'products' => Product::with(['category', 'inventory'])->get(),
            'categories' => Category::all(),
            'lowStockProducts' => Product::whereHas('inventory', function($query) use ($threshold) {
                $query->where('quantity', '<', $threshold);
            })->with('inventory')->get()
        ]);
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
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $productData = $validated;
            if ($request->hasFile('product_image')) {
                $imagePath = $request->file('product_image')->store('product_images', 'public');
                $productData['product_image'] = $imagePath;
            }

        Product::create($validated);
        return redirect()->route('staff.products')->with('success', 'Product added successfully!');
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
        return view('TurboParts.Staff.Products', compact('products', 'categories'));
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
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $productData = $validated;

      
        if ($request->hasFile('product_image')) {
            
            if ($product->product_image) {
                Storage::disk('public')->delete($product->product_image);
            }
            
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $productData['product_image'] = $imagePath;
        }

        $product->update($validated);
        return redirect()->route('staff.products')->with('success', 'Product updated successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try{
            if ($product->product_image) {
                Storage::disk('public')->delete($product->product_image);
            }

            $product->delete();
            return redirect()->route('staff.products')
            ->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('staff.products')
            ->with('error', 'Error deleting product:' .$e->getMessage());
        }
    }

}
