<!DOCTYPE html>
<html>
    <head>
        <title>Главная</title>
    </head>
    <body>
        @auth
            <p>Здравствуйте, {{ Auth::user()->name }}</p>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Выйти</button>
            </form>
        @else
        <a href="{{ route('login') }}">
            <button>Войти</button>
        </a>
        <a href="{{ route('register') }}">
            <button>Зарегистрироваться</button>
        </a>
    @endauth
        @if(session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif
        <div style="margin-bottom: 20px;">
            <a href="{{ route('checkout') }}" style="margin-right: 10px;">
                <button>Корзина</button>
            </a>
            <a href="{{ route('orders.index') }}">
                <button>Заказы</button>
            </a>
        </div>
        <h1>Продукты</h1>
        @foreach($products as $product)
            <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc;">
                <p><strong>Наименование:</strong> {{ $product->name }}</p>
                <p><strong>Цена:</strong> {{ $product->price }} руб.</p>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <label for="quantity{{ $product->id }}"><strong>Количество:</strong></label>
                    <input type="number" id="quantity{{ $product->id }}" name="quantity" value="1" min="1"> шт.
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit">В корзину</button>
                </form>
            </div>
        @endforeach
    </body>
</html>
