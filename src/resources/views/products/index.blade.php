@extends('layouts.app')

@section('content')
<div class="product-page">
    <div class="sidebar">
        <h2>商品一覧</h2>
        <form method="GET" action="{{ route('products.index') }}">
            <input type="text" name="keyword" placeholder="商品名で検索" class="search-input" value="{{ request('keyword') }}" />
            <button type="submit" class="search-btn">検索</button>

            <div class="filter-box">
                <label>価格順で表示</label>
                <select name="sort">
                    <option value="">価格で並び替え</option>
                    <option value="asc" {{ request('sort')=='asc' ? 'selected' : '' }}>価格が安い順</option>
                    <option value="desc" {{ request('sort')=='desc' ? 'selected' : '' }}>価格が高い順</option>
                </select>
            </div>

            @if(request('keyword') || request('sort'))
                <a href="{{ route('products.index') }}" class="reset-btn">× リセット</a>
            @endif
        </form>
    </div>

    <div class="product-list">
        @forelse ($products as $product)
            <div class="product-card" onclick="location.href='{{ route('products.show', $product->id) }}'">
                <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}" />
                <div class="info">
                    <p class="name">{{ $product->name }}</p>
                    <p class="price">¥{{ number_format($product->price) }}</p>
                </div>
            </div>
        @empty
            <p>商品が見つかりませんでした。</p>
        @endforelse
    </div>

    <div class="pagination-area">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
