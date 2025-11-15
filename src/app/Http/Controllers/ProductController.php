<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // 商品一覧
    public function index(Request $request)
    {
        $query = Product::query();

        // キーワード検索（部分一致）
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 並び替え
        if ($request->filled('sort')) {
            if ($request->sort === 'asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'desc') {
                $query->orderBy('price', 'desc');
            }
        }

        // ページネーション（6件ずつ）
        $products = $query->paginate(6);

        return view('products.index', compact('products'));
    }

    // 商品登録フォーム
    public function create()
    {
        return view('products.create');
    }

    // 商品登録保存
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('images', 'public');

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => basename($path),
        ]);

        return redirect()->route('products.index')->with('success', '商品を追加しました。');
    }

    // 商品詳細
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
