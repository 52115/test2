<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '商品一覧')</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="header-container">
            <h1>商品管理アプリ</h1>
            <nav>
                <a href="{{ route('products.create') }}" class="btn-add">+商品を追加</a>
            </nav>
        </div>
    </header>

    <main class="main-content">
        @yield('content')
    </main>
</body>
</html>

<style>
/* ヘッダー */
.header {
    background-color: #2d3748;
    color: white;
    padding: 20px;
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header h1 {
    margin: 0;
}

.btn-add {
    color: white;
    text-decoration: none;
    background-color: #48bb78;
    padding: 8px 15px;
    border-radius: 5px;
}

.main-content {
    padding: 20px;
}
</style>
