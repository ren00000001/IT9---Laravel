<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{

     public function processPayment(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'payment_method' => 'required|string|in:cash,credit_card,debit_card,other',
            'total_amount' => 'required|numeric|min:0'
        ]);

        try {
            // Create the order using your existing method
            $order = Order::createFromPos(
                $request->items,
                $request->payment_method,
                Auth::id()
            );

            // Update inventory
            foreach ($request->items as $item) {
                $product = Product::find($item['productId']);
                if ($product && $product->inventory) {
                    $product->inventory->decrement('stocks_quantity', $item['quantity']);
                }
            }

            return response()->json([
                'success' => true,
                'order_id' => $order->order_id,
                'order_date' => $order->order_date->format('Y-m-d H:i:s'),
                'total' => $order->total,
                'message' => 'Payment processed successfully'
            ]);

        }  catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error processing payment: ' . $e->getMessage()
            ], 500);
        }
    }

}