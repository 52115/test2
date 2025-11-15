<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '商品一覧')</title>
    @yield('css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="header-container">
            <h1>mogitate</h1>
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
    background-color: #fdf7f3;
    color: orange;
    padding: 20px;
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header h1 {
    margin: 0;
    font-style: italic;
    font-size: 18pt;
}

.main-content {
    padding: 20px;
    font-family: 'Open Sans', sans-serif;
}

/* 見出しにはMontserratを使用 */
h1, h2, h3, h4, h5, h6 {
  font-family: 'Montserrat', sans-serif;
  font-weight: normal;
}
</style>
