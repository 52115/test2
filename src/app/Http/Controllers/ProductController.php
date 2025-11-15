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
    public function index()
    {
        $products = Product::with('seasons')->orderBy('id', 'desc')->paginate(10);
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
     * 商品登録処理（画像アップロード・季節紐付け含む）
     */
    public function store(ProductStoreRequest $request)
    {
        // 画像アップロード（storage/app/public/images）
        $imagePath = $request->file('image')->store('images', 'public');

        // 商品登録
        $product = Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'image_path'  => $imagePath,
        ]);

        // 季節の紐付け（多対多）
        if ($request->season_ids) {
            $product->seasons()->attach($request->season_ids);
        }

        return redirect()->route('products.index')->with('success', '商品を登録しました');
    }

    /**
     * 商品詳細（PG02）
     */
    public function show($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        return view('products.show', compact('product'));
    }

    /**
     * 商品編集画面
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
        $product = Product::findOrFail($productId);

        // 画像が再アップロードされた場合
        if ($request->hasFile('image')) {

            // 古い画像を削除
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }

            $imagePath = $request->file('image')->store('images', 'public');
            $product->image_path = $imagePath;
        }

        // 商品情報更新
        $product->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
        ]);

        // 季節の更新（中間テーブル）
        $product->seasons()->sync($request->season_ids);

        return redirect()->route('products.index')->with('success', '商品情報を更新しました');
    }

    /**
     * 商品削除
     */
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        // 画像削除
        if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }

        // 関連季節も削除
        $product->seasons()->detach();

        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }
}
