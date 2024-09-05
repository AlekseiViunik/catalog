<!DOCTYPE html>
<html>
    <head>
        <title>Заказы</title>
    </head>
    <body>
        <div style="margin-bottom: 20px;">
            <a href="{{ route('products.index') }}">
                <button>Назад на главную</button>
            </a>
        </div>
        <h1>Заказы</h1>
        @foreach($orders as $order)
            <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc;">
                <p><strong>Заказ #{{ $order->id }} - {{ $order->created_at }}</strong></p>
                <p><strong>Продукты:</strong>
                    @foreach($order->products as $product)
                        {{ $product->name }} - {{ $product->pivot->quantity }} шт{{ $loop->last ? '' : ',' }}
                    @endforeach
                </p>
                <p><strong>Итого:</strong> {{ $order->products->sum(fn($p) => $p->pivot->price * $p->pivot->quantity) }} руб.</p>
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this order?');">Удалить заказ</button>
                </form>
            </div>
        @endforeach
    </body>
</html>
