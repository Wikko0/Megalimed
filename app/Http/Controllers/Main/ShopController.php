<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(): View
    {
        $products = Product::where('status', 'Published')->paginate(12);
        $products->appends(request()->query());

        return view('main.shop', compact('products'));
    }

    public function categories($url): View
    {
        $categories = Category::where('url', $url)->first();

        if (!$categories) {
            abort(404);
        }

        $products = Product::where(['category_id' => $categories->id, 'status' => 'Published'])->paginate(12);
        $products->appends(request()->query());

        return view('main.shop', compact('products'));
    }
}
