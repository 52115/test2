@extends('layouts.app')

@section('title', '商品詳細・編集')
@section('css')
<link rel="stylesheet" href="{{ asset('css/products/edit.css') }}">
@endsection

@section('content')
<div class="detail-container">

    <div class="breadcrumb">
        <a href="{{ route('products.index') }}" class="link">商品一覧</a> > {{ $product->name }}
    </div>

    {{-- 編集フォーム（ここで閉じる） --}}
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="edit-form">
        @csrf

        <div class="content-wrapper">
            <div class="left-box">
                <img src="{{ asset('storage/' . $product->image) }}" class="product-image">

                <div class="file-wrapper">
                    <label for="image" class="file-label">ファイルを選択</label>
                    <input id="image" type="file" name="image" class="file-input">
                    @error('image')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <p class="file-name">{{ basename($product->image) }}</p>
            </div>

            <div class="right-box">
                <div class="form-group">
                    <label class="form-label">商品名</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="input-text">
                    @error('name') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">値段</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" class="input-text">
                    @error('price') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">季節（複数選択可）</label>
                    <div class="season-options">
                        @foreach ($seasons as $season)
                            <label class="season-label">
                                <input type="checkbox"
                                       name="season_ids[]"
                                       value="{{ $season->id }}"
                                       {{ (collect(old('season_ids', $product->seasons->pluck('id')->toArray()))->contains($season->id)) ? 'checked' : '' }}>
                                {{ $season->name }}
                            </label>
                        @endforeach
                    </div>
                    @error('season_ids') <p class="error">{{ $message }}</p> @enderror
                </div>

            </div>
        </div>

        <div class="description-box">
            <label class="form-label">商品説明</label>
            <textarea name="description" class="textarea">{{ old('description', $product->description) }}</textarea>
            @error('description') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="buttons">
            <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-save">変更を保存</button>
        </div>

    </form> {{-- ← 編集フォームここで終了 --}}

    {{-- 削除フォームは上のフォームの外に配置（入れ子禁止） --}}
    <div class="delete-area" style="margin-top:12px;">
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            <button type="submit" class="btn-delete">🗑 商品を削除</button>
        </form>
    </div>

</div>
@endsection
