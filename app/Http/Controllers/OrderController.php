<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        // Assuming you have menu items in the database
        $menuItems = MenuItem::all();
        return view('orders.create', compact('menuItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|integer',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',


        ]);

        $order = Order::create([
            'table_number' => $request->table_number,
            'status' => 'pending',
            'notes' => $request->notes,

        ]);

        foreach ($request->items as $item) {
            $menuItem = MenuItem::find($item['id']);
            if ($menuItem) {

                $order->items()->create([
                    'menu_item_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'item_name' => $menuItem ? $menuItem->name : 'Unknown Item' ,
                    'category' => $menuItem ? $menuItem->category : '',

                ]);
            }
        }

        return redirect()->route('kitchen.display')->with('success', 'Order created successfully');
    }
}
