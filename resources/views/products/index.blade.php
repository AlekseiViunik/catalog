<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
    </head>
    <body>
        @if(session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif
        <div style="margin-bottom: 20px;">
            <a href="{{ route('checkout') }}" style="margin-right: 10px;">
                <button>Cart</button>
            </a>
            <a href="{{ route('orders.index') }}">
                <button>Orders</button>
            </a>
        </div>
        <h1>Products</h1>
        @foreach($products as $product)
            <div>
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->price }}</p>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        @endforeach
    </body>
</html>
