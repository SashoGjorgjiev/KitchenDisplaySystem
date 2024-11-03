<div>

    <x-slot name="header">



        @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md">
            {{ session('success') }}
        </div>
        @endif
        <div class="flex justify-between items-center ">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Active Orders</h2>
            <!-- Add button to redirect to order creation page -->
            <a href="{{ route('orders.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded rounded-md my-2">
                Create New Order
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($activeOrders as $order)
            <div class="bg-white rounded-lg shadow-lg p-4">
                <h3 class="text-lg font-bold">Table {{ $order->table_number }}</h3>
                @if($order->customer_name)
                <p class="text-gray-600">{{ $order->customer_name }}</p>
                @endif
                <p>Status: {{ $order->status }}</p>

                <div class="space-y-2">
                    @foreach($order->items as $item)
                    <div class="border rounded p-2 @if($item->status === 'ready') bg-green-50 @endif">
                        <div class="flex justify-between items-start">
                            <div>
                                <span class="font-medium">{{ $item->quantity }}x {{ $item->item_name }}</span>
                                @if($item->special_instructions)
                                <p class="text-sm text-red-600">{{ $item->special_instructions }}</p>
                                @endif
                            </div>
                            <button wire:click="updateItemStatus({{ $item->id }}, '{{ $item->status === 'pending' ? 'cooking' : ($item->status === 'cooking' ? 'ready' : 'pending') }}')">
                                {{ ucfirst($item->status) }}
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-4 flex justify-end space-x-2">
                    @if($order->status === 'pending')
                    <button wire:click="updateOrderStatus({{ $order->id }}, 'preparing')" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Start Order
                    </button>
                    @elseif($order->status === 'preparing')
                    <button wire:click="updateOrderStatus({{ $order->id }}, 'ready')" class="bg-green-500 text-white px-4 py-2 rounded">
                        Complete Preparation
                    </button>
                    @elseif($order->status === 'ready')
                    <button wire:click="updateOrderStatus({{ $order->id }}, 'completed')" class="bg-yellow-500 text-white px-4 py-2 rounded">
                        Mark as Completed
                    </button>
                    @endif
                </div>

            </div>
            @endforeach
        </div>
</div>
</x-slot>