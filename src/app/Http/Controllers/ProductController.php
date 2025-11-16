<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * 商品一覧
     */
    public function index(Request $request)
    {
    $query = Product::with('seasons');

    // 🔍 キーワード検索
    if ($request->filled('keyword')) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

    // 💰 価格ソート
    if ($request->filled('sort')) {
        $query->orderBy('price', $request->sort);
    } else {
        // sort が指定されていないときのデフォルト
        $query->orderBy('id', 'desc');
    }

    // 📄 ページネーション（検索条件維持）
    $products = $query->paginate(6)->withQueryString();

    return view('products.index', compact('products'));
    }

    /**
     * 商品登録画面
     */
    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    /**
     * 商品登録処理
     */
    public function store(ProductStoreRequest $request)
    {
        // 画像アップロード
        $imagePath = $request->file('image')->store('images', 'public');

        // 商品登録
        $product = Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => $imagePath,   // ← image に保存
        ]);

        // 中間テーブル（季節）
        if ($request->season_ids) {
            $product->seasons()->attach($request->season_ids);
        }

        return redirect()->route('products.index')->with('success', '商品を登録しました');
    }

    /**
     * 統合した商品詳細 + 編集画面
     */
    public function edit($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all();

        return view('products.edit', compact('product', 'seasons'));
    }

    /**
     * 商品更新処理
     */
    public function update(ProductUpdateRequest $request, $productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);

        // 画像変更がある場合
        if ($request->hasFile('image')) {

            // 古い画像を削除
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // 新しい画像の保存
            $product->image = $request->file('image')->store('images', 'public');
        }

        // 商品情報更新
        $product->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => $product->image,   // ← image_path → image
        ]);

        // 季節（checkbox）
        $seasonIds = $request->input('season_ids', []);
        $product->seasons()->sync($seasonIds);

        return redirect()->route('products.index')
            ->with('success', '商品情報を更新しました');
    }

    /**
     * 商品削除処理
     */
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        // 画像削除
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // 中間テーブル
        $product->seasons()->detach();

        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }
}
