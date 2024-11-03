<x-app-layout>
    <div class="container mx-auto px-4 py-6 text-white">
        <h1 class="text-2xl font-bold mb-6">Create New Order</h1>

        <div class="row flex flex-row justify-center ">
            <div class="col-6 offset-3 bg-gray-800 p-6 rounded-lg shadow-lg mx-2 ">
                <form action="{{ route('orders.store') }}" method="POST" class="max-w-lg">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-300 font-bold mb-2">Table Number</label>
                        <input type="number" style="color: gray;" name="table_number" class="form-input w-full bg-gray-700 border border-gray-600 text-gray-300 p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-300 font-bold mb-2">Select Items</label>
                        <div id="orderItems">
                            <div class="flex space-x-4 mb-2">
                                <select name="items[0][id]" style="color: gray;" class="form-select flex-1 bg-gray-700 border border-gray-600 text-gray-300 p-2 rounded">
                                    @foreach($menuItems as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} - ${{ $item->price }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="items[0][quantity]" style="color: gray;" placeholder="Qty" class="form-input w-24 bg-gray-700 border border-gray-600 text-gray-300 p-2 rounded" value="1" min="1">
                                <button type="button" onclick="removeItem(this)" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Remove</button>
                            </div>
                        </div>
                        <button type="button" onclick="addItem()" class="bg-blue-600 text-white px-4 py-2 rounded mt-2 hover:bg-blue-700">Add Item</button>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-300 font-bold mb-2">Notes</label>
                        <textarea name="notes" style="color: gray;" class="form-textarea w-full bg-gray-700 border border-gray-600 text-gray-300 p-2 rounded" rows="3"></textarea>
                    </div>

                    <button type="submit" style="background-color: #16a34a;" class="text-white px-6 py-2 rounded button-animate">Create Order</button>
                </form>
            </div>
            <div class="col-6 offset-3 bg-gray-800 p-6 rounded-lg shadow-lg mx-2 ">
                <img src="https://t4.ftcdn.net/jpg/03/32/75/39/360_F_332753934_tBacXEgxnVplFBRyKbCif49jh0Wz89ns.jpg" alt="">
            </div>
        </div>

    </div>

    <script>
        let itemCount = 1;

        function addItem() {
            const itemsDiv = document.getElementById('orderItems');
            const newItem = document.createElement('div');
            newItem.className = 'flex space-x-4 mb-2';
            newItem.innerHTML = `
        <select name="items[${itemCount}][id]" class="form-select flex-1 bg-gray-700 border border-gray-600 text-gray-300 p-2 rounded">
            @foreach($menuItems as $item)
                <option value="{{ $item->id }}">{{ $item->name }} - ${{ $item->price }}</option>
            @endforeach
        </select>
        <input type="number" name="items[${itemCount}][quantity]" placeholder="Qty" class="form-input w-24 bg-gray-700 border border-gray-600 text-gray-300 p-2 rounded" value="1" min="1">
        <button type="button" onclick="removeItem(this)" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Remove</button>
    `;
            itemsDiv.appendChild(newItem);
            itemCount++;
        }

        function removeItem(button) {
            button.parentElement.remove();
        }
    </script>
</x-app-layout>