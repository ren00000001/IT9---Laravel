<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $orders = Order::with('user')->orderBy('order_date', 'desc')->get();

       return view('TurboParts.Cashier.FullHistory', compact('orders'));
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
        try {
            $validated = $request->validate([
                'items' => 'required|array',
                'items.*.productId' => 'required|exists:products,product_id',
                'payment_method' => 'required|in:cash,credit_card,debit_card',
                'cash_amount' => 'nullable|required_if:payment_method,cash|numeric|min:0'
            ]);

            $total = collect($request->items)->sum(function($item) {
                return $item['price'] * $item['quantity'];
            });

            $orderData = [
                'order_date' => now(),
                'total' => $total,
                'user_id' => Auth::id(),
                'customer_count' => 1,
                'payment_method' => $request->payment_method
            ];

            // Only store cash_amount if payment is cash
            if ($request->payment_method === 'cash') {
                $orderData['cash_amount'] = $request->cash_amount;
            }

            $order = Order::create($orderData);

            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item['productId'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'total_amount' => $item['price'] * $item['quantity']
                ]);

                Inventory::where('product_id', $item['productId'])
                    ->decrement('stocks_quantity', $item['quantity']);
            }

            return response()->json([
                'success' => true,
                'order_id' => $order->order_id,
                'message' => 'Order processed successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function showReceipt($order_id)
    {
        try {
            $order = Order::with(['items.product', 'user'])->findOrFail($order_id);
            
            return response()->json([
                'success' => true,
                'order' => [
                    'order_id' => $order->order_id,
                    'order_date' => $order->order_date,
                    'total' => $order->total,
                    'payment_method' => $order->payment_method,
                    'cash_amount' => $order->cash_amount, // Add this line
                    'user' => $order->user ? [
                        'user_firstname' => $order->user->user_firstname,
                        'user_lastname' => $order->user->user_lastname
                    ] : null
                ],
                'items' => $order->items->map(function($item) {
                    return [
                        'product' => [
                            'product_name' => $item->product->product_name ?? 'Unknown Product'
                        ],
                        'quantity' => $item->quantity,
                        'unit_price' => $item->unit_price,
                        'total_amount' => $item->total_amount
                    ];
                })
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading receipt: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
