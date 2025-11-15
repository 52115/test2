@extends('layouts.app')

@section('title', '商品詳細')
@section('css')
<link rel="stylesheet" href="{{ asset('css/products/show.css') }}">
@endsection
@section('content')
<div class="detail-container">

    <div class="detail-card">

        {{-- 左カラム：画像 --}}
        <div class="detail-image-area">
            <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}">
        </div>

        {{-- 右カラム：情報 --}}
        <div class="detail-info-area">

            <h1 class="detail-name">{{ $product->name }}</h1>

            <p class="detail-price">￥{{ number_format($product->price) }}</p>

            {{-- 季節（複数） --}}
            <div class="detail-seasons">
                @foreach ($product->seasons as $season)
                    <span class="season-tag">{{ $season->name }}</span>
                @endforeach
            </div>

            <p class="detail-description">{{ $product->description }}</p>

            {{-- ボタンエリア --}}
            <div class="detail-buttons">

                <a href="{{ route('products.index') }}" class="btn-back">
                    ← 戻る
                </a>

                <a href="{{ route('products.edit', $product->id) }}" class="btn-edit">
                    変更する
                </a>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete" onclick="return confirm('本当に削除しますか？')">
                        🗑 削除
                    </button>
                </form>

            </div>

        </div>
    </div>

</div>
@endsection
