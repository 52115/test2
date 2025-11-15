@extends('layouts.app')

@section('title', '商品登録')
@section('css')
<link rel="stylesheet" href="{{ asset('css/products/create.css') }}">
@endsection
@section('content')
<div class="register-container">

    <h2 class="page-title">商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="register-form">
        @csrf

        {{-- 商品名 --}}
        <div class="form-group">
            <label>商品名</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 値段 --}}
        <div class="form-group">
            <label>値段（0〜10000 円）</label>
            <input type="number" name="price" value="{{ old('price') }}">
            @error('price')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 季節（複数選択） --}}
        <div class="form-group">
            <label>季節（複数選択可）</label>
            <select name="seasons[]" multiple>
                @foreach ($seasons as $season)
                    <option value="{{ $season->id }}"
                        {{ collect(old('seasons'))->contains($season->id) ? 'selected' : '' }}>
                        {{ $season->name }}
                    </option>
                @endforeach
            </select>
            @error('seasons')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 画像 --}}
        <div class="form-group">
            <label>商品画像（png/jpeg）</label>
            <input type="file" name="image">
            @error('image')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 説明 --}}
        <div class="form-group">
            <label>商品説明（120文字以内）</label>
            <textarea name="description" rows="4">{{ old('description') }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- ボタン --}}
        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-register">登録</button>
        </div>

    </form>

</div>
@endsection
