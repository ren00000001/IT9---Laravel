<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $inventories = Inventory::with('product')->get();

       return view('TurboParts.Staff.Inventory', [
        'inventories' => $inventories,
        'categories' => Category::all()
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
         return response()->json([
            'inventory' => $inventory,
            'product' => $inventory->product
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'stocks_quantity' => 'required|integer|min:0'
        ]);

        $inventory->update($validated);

        return redirect()->route('staff.inventory')
        ->with('success', 'Stock quantity updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
