@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/products/edit.css') }}">
@endsection
@section('content')
<div class="container">
    <h1 class="mb-4">商品編集</h1>

    <div class="card p-4">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- 商品名 --}}
            <div class="mb-3">
                <label class="form-label">商品名</label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       name="name" 
                       value="{{ old('name', $product->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- 価格 --}}
            <div class="mb-3">
                <label class="form-label">価格（円）</label>
                <input type="number" 
                       class="form-control @error('price') is-invalid @enderror" 
                       name="price" 
                       value="{{ old('price', $product->price) }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- 説明 --}}
            <div class="mb-3">
                <label class="form-label">説明</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          name="description" 
                          rows="4">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- 画像 --}}
            <div class="mb-3">
                <label class="form-label">商品画像（任意）</label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       name="image">

                @if ($product->image)
                    <div class="mt-2">
                        <label>現在の画像：</label><br>
                        <img src="{{ asset('storage/images/' . $product->image) }}" 
                             alt="" 
                             class="img-thumbnail" 
                             style="max-width: 200px;">
                    </div>
                @endif

                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- 季節（多対多） --}}
            <div class="mb-3">
                <label class="form-label">季節</label>
                <div class="d-flex flex-wrap">
                    @foreach ($seasons as $season)
                        <div class="form-check me-3">
                            <input type="checkbox"
                                   name="seasons[]"
                                   class="form-check-input"
                                   value="{{ $season->id }}"
                                   {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $season->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ボタン --}}
            <div class="d-flex gap-3 mt-4">
                <button type="submit" class="btn btn-primary px-4">更新する</button>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary px-4">
                    戻る
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
