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
            <label class="form-label">商品名 <span class="required">必須</span></label>
            <input type="text" name="name" value="{{ old('name') }}" class="input-text">
            @error('name') <p class="error">{{ $message }}</p> @enderror
        </div>

        {{-- 値段 --}}
        <div class="form-group">
            <label class="form-label">値段 <span class="required">必須</span></label>
            <input type="number" name="price" value="{{ old('price') }}" class="input-text">
            @error('price') <p class="error">{{ $message }}</p> @enderror
        </div>

        {{-- 商品画像 --}}
        <div class="form-group">
            <label class="form-label">商品画像 <span class="required">必須</span></label>
            <input type="file" name="image" class="input-file">
            @error('image') <p class="error">{{ $message }}</p> @enderror
        </div>

        {{-- 季節 --}}
        <div class="form-group">
            <label class="form-label">季節 <span class="required">複数選択可</span></label>
            <div class="season-options">
                @foreach ($seasons as $season)
                <label class="season-label">
                    <input type="checkbox" name="seasons[]"
                        value="{{ $season->id }}"
                        {{ collect(old('seasons'))->contains($season->id) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label>
                @endforeach
            </div>
            @error('seasons') <p class="error">{{ $message }}</p> @enderror
        </div>

        {{-- 商品説明 --}}
        <div class="form-group">
            <label class="form-label">商品説明 <span class="required">必須</span></label>
            <textarea name="description" rows="4" class="textarea">{{ old('description') }}</textarea>
            @error('description') <p class="error">{{ $message }}</p> @enderror
        </div>

        {{-- ボタン --}}
        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-register">登録</button>
        </div>

    </form>
</div>
@endsection
