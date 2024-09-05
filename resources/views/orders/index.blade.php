<!DOCTYPE html>
<html>
    <head>
        <title>Orders</title>
    </head>
    <body>
        <div style="margin-bottom: 20px;">
            <a href="{{ route('products.index') }}">
                <button>Back</button>
            </a>
        </div>
        <h1>Orders</h1>
        @foreach($orders as $order)
            <div>
                <p>Order #{{ $order->id }} - {{ $order->created_at }}</p>
                <p>Products: {{ $order->products->pluck('name')->join(', ') }}</p>
                <p>Total: {{ $order->products->sum(fn($p) => $p->pivot->price * $p->pivot->quantity) }}</p>
            </div>
        @endforeach
    </body>
</html>
