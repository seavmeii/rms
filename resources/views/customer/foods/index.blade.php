@extends('layouts.app')

@section('content')
<div class="flex flex-col lg:flex-row gap-6">

    <!-- Left: Food menu -->
    <div class="flex-1">

<!-- Categories -->
<div class="mb-6 flex flex-wrap gap-3">
    <span class="font-semibold mr-2">Categories:</span>

    <a href="{{ route('customer.foods.index') }}"
       class="px-4 py-2 rounded-full font-semibold text-sm transition-all duration-300 transform
              {{ !request('category_id') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md scale-105' : 'bg-gray-100 text-gray-800 hover:bg-gradient-to-r hover:from-blue-400 hover:to-blue-500 hover:text-white hover:scale-105' }}">
        All
    </a>

    @foreach($categories as $category)
        <a href="{{ route('customer.foods.category', $category->id) }}"
           class="px-4 py-2 rounded-full font-semibold text-sm transition-all duration-300 transform
                  {{ request()->route('category_id') == $category->id ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md scale-105' : 'bg-gray-100 text-gray-800 hover:bg-gradient-to-r hover:from-blue-400 hover:to-blue-500 hover:text-white hover:scale-105' }}">
            {{ $category->name }}
        </a>
    @endforeach
</div>

        <!-- Foods -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($foods ?? [] as $food)
            <div class="bg-white rounded-lg shadow flex flex-col overflow-hidden">
                @php $foodImage = $food->image ? asset('storage/' . $food->image) : null; @endphp
                @if($foodImage)
                <img src="{{ $foodImage }}" alt="{{ $food->name }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                    No Image
                </div>
                @endif

                <div class="p-4 flex flex-col flex-1">
                    <h3 class="font-semibold text-lg">{{ $food->name }}</h3>
                    <p class="text-gray-700 font-bold mt-2">${{ number_format($food->price, 2) }}</p>

                    <button class="bg-blue-500 text-white w-full py-2 rounded hover:bg-blue-600 mt-2 add-to-cart-btn"
                            data-id="{{ $food->id }}"
                            data-name="{{ $food->name }}"
                            data-price="{{ $food->price }}"
                            data-image="{{ $foodImage }}">
                        Add to Cart
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $foods->withQueryString()->links() }}
        </div>
    </div>

    <!-- Right: Cart Preview -->
    <div class="w-full lg:w-96 bg-gray-50 p-4 rounded shadow sticky top-6 h-fit">
        <h2 class="text-xl font-bold mb-4">Your Cart</h2>
        <ul id="cart-items" class="space-y-2 mb-4"></ul>
        <p class="font-semibold">Total: $<span id="cart-total">0.00</span></p>

        <form id="checkout-form" method="POST" action="{{ route('customer.cart.placeOrder') }}">
            @csrf
            <input type="hidden" name="cart_data" id="cart_data">
            <button type="submit" id="place-order-btn" class="bg-green-500 text-white px-4 py-2 rounded w-full mt-2">
                Place Order
            </button>
        </form>
    </div>

</div>

<script>
    let cart = [];

    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const name = btn.dataset.name;
            const price = parseFloat(btn.dataset.price);
            const image = btn.dataset.image;
            const item = cart.find(i => i.id == id);
            if (item) item.quantity++;
            else cart.push({id, name, price, quantity:1, image});
            updateCartUI();
        });
    });

    function updateCartUI() {
        const cartItems = document.getElementById('cart-items');
        const cartTotal = document.getElementById('cart-total');
        cartItems.innerHTML = '';
        let total = 0;
        cart.forEach((item, index) => {
            total += item.price * item.quantity;
            const li = document.createElement('li');
            li.innerHTML = `
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <img src="${item.image}" class="w-12 h-12 object-cover rounded">
                        <span>${item.name} x ${item.quantity}</span>
                    </div>
                    <button onclick="removeFromCart(${index})" class="text-red-500 text-sm hover:underline">Remove</button>
                </div>
            `;
            cartItems.appendChild(li);
        });
        cartTotal.textContent = total.toFixed(2);
        document.getElementById('cart_data').value = JSON.stringify(cart);
    }

    function removeFromCart(index) {
        cart.splice(index,1);
        updateCartUI();
    }
</script>
@endsection