<?php
// app/Livewire/KitchenDisplay.php

namespace App\Http\Livewire;

use Log;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Livewire\WithPagination;

class KitchenDisplay extends Component
{
    use WithPagination;


    public function updateOrderStatus($orderId, $newStatus)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => $newStatus]);

        if ($newStatus === 'preparing') {
            $order->update(['started_at' => now()]);
        } elseif ($newStatus === 'completed') {
            $order->update(['completed_at' => now()]);
        }
    }
    public function updateItemStatus($itemId, $newStatus)
    {
        $orderItem = OrderItem::findOrFail($itemId);
        $orderItem->update(['status' => $newStatus]);

        if ($newStatus === 'pending') {
            $orderItem->update(['started_cooking_at' => now()]);
        } elseif ($newStatus === 'ready') {
            $orderItem->update(['completed_at' => now()]);
        }
        $this->emit('statusUpdated');
    }

    public function render()
    {
        $activeOrders = Order::with(['items.menuItem'])
            ->whereIn('status', ['pending', 'preparing'])
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'asc')
            ->get();

        $completedOrders = Order::with(['items'])
            ->where('status', ['ready', 'completed'])
            ->whereDate('completed_at', today())
            ->count();

        $cookingItems = OrderItem::where('status', 'cooking')->count();
        $readyItems = OrderItem::where('status', 'ready')->count();


        return view('livewire.kitchen-display', [
            'activeOrders' => $activeOrders,
            'completedOrders' => $completedOrders,
            'cookingItems' => $cookingItems,
            'readyItems' => $readyItems
        ])->layout('layouts.app');
    }
}
