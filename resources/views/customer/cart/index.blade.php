<x-cart>
    <div class="cart-container">
        <div class="cart-header">
            <h2>Your Cart</h2>
        </div>
        @php $cart = $cart ?? session('cart', []); @endphp

        @if(count($cart) > 0)
        <div class="cart-items space-y-4">
            @php $total = 0; @endphp

            @foreach($cart as $id => $item)
                @php
                    $subtotal = ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
                    $total += $subtotal;
                @endphp
            <div class="cart-item">
                <div class="item-image">
                    @if(Str::startsWith($item['image'], ['http://','https://']))
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                    @elseif(file_exists(public_path($item['image'])))
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                    @else
                        <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}">
                    @endif
                </div>
                <div class="item-details">
                    <span class="item-name">{{ $item['name'] }}</span>
                    <span class="item-price">${{ $item['price'] }} x {{ $item['quantity'] }}</span>
                    <span class="item-subtotal">Subtotal: ${{ $subtotal }}</span>
                </div>
                <div class="item-actions">
                    <form action="{{ route('customer.cart.remove', ['id' => $id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="background:none;border:none;color:#ef4444;text-decoration:underline;cursor:pointer;"
                                onclick="return confirm('Are you sure you want to remove this item?')">
                            Remove
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <div class="cart-summary">
            <div class="total-price">
                Total: ${{ $total }}
            </div>

            <form method="POST" target="aba_webservice"
                action="https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase"
                id="aba_merchant_request">
                @csrf
                <input type="hidden" name="hash" value="{{ $hash ?? '' }}" id="hash" />
                <input type="hidden" name="tran_id" value="{{ $tranId ?? '' }}" id="tran_id" />
                <input type="hidden" name="amount" value="{{ $amount ?? '' }}" id="amount" />
                <input type="hidden" name="payment_option" value="{{ $payment_option ?? '' }}" />
                <input type="hidden" name="merchant_id" value="{{ $merchant_id ?? '' }}" />
                <input type="hidden" name="req_time" value="{{ $req_time ?? '' }}" />
                <input type="hidden" name="currency" value="{{ $currency ?? '' }}" />
            </form>

            <input type="button" id="checkout_button" value="Checkout Now" class="checkout-btn">
        </div>

       @else
<div class="empty-state">
    <div class="empty-icon">🛒</div>
    <div class="empty-text">Your cart is currently empty.</div>
    <a href="{{ route('customer.foods.index') }}" class="btn-continue">Continue Shopping</a>
</div>
@endif
    </div>
</x-cart>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.payway.com.kh/plugins/checkout2-0.js"></script>

<script>
    $(document).ready(function() {
        $('#checkout_button').click(function() {
            if ($(".payment_option:checked").length > 0) {
                $('#aba_merchant_request').append($(".payment_option:checked"));
            }
            AbaPayway.checkout();
        });
    });
</script>