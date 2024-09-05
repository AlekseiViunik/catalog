<!DOCTYPE html>
<html>
    <head>
        <title>Корзина</title>
    </head>
    <body>
        @if(session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif
        <div style="margin-bottom: 20px;">
            <a href="{{ route('products.index') }}">
                <button>Назад на главную</button>
            </a>
        </div>
        <h1>Корзина</h1>
        @if($cart)
            @foreach($cart as $id => $details)
                <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc;">
                    <p><strong>Наименование:</strong> {{ $details['name'] }}</p>
                    <p><strong>Количество:</strong> {{ $details['quantity'] }}</p>
                    <p><strong>Сумма:</strong> {{ $details['price'] * $details['quantity'] }} руб.</p>
                </div>
            @endforeach
            <p><strong>Итого:</strong> {{ $total }} руб.</p>
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <button type="submit">Разместить заказ</button>
            </form>
        @else
            <p>Ваша корзина пуста!</p>
        @endif
    </body>
</html>
