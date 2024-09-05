<!DOCTYPE html>
<html>
    <head>
        <title>Checkout</title>
    </head>
    <body>
        @if(session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif
        <div style="margin-bottom: 20px;">
            <a href="{{ route('products.index') }}">
                <button>Back</button>
            </a>
        </div>
        <h1>Checkout</h1>
        @if(session('error'))
            <p>{{ session('error') }}</p>
        @endif
        @if($cart)
            <ul>
                @foreach($cart as $id => $details)
                    <li>{{ $details['name'] }} - {{ $details['quantity'] }}
                        - {{ $details['price'] * $details['quantity'] }}</li>
                @endforeach
            </ul>
            <p>Total: {{ $total }}</p>
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <button type="submit">Place Order</button>
            </form>
        @else
            <p>Your cart is empty!</p>
        @endif
    </body>
</html>
