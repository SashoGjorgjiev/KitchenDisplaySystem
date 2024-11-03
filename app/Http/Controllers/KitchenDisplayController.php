<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class KitchenDisplayController extends Controller
{
    public function index()
    {
        $activeOrders = Order::with('items')
            ->whereIn('status', ['preparing', 'ready', 'pending,completed'])
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('livewire.kitchen-display', compact('activeOrders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,in_progress,ready,completed,cancelled',
        ]);

        $order->update($validated);

        return response()->json(['success' => true]);
    }

    public function updateItemStatus(Request $request, OrderItem $item)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,cooking,ready',
        ]);

        $item->update($validated);

        return response()->json(['success' => true]);
    }
}
