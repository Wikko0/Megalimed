<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function view;

class HomeController extends Controller
{
    public function index(): View
    {
        $recommendedProducts = Product::recommendedProducts(auth()->id());

        return view('main.home', ['recommendedProducts' => $recommendedProducts]);
    }

    public function getProductsByCategory(Request $request)
    {
        $categoryId = $request->get('category_id');

        if ($categoryId == 'all') {
            // Показване на всички продукти
            $products = Product::where('status', 'Published')->take(8)->get();
        } else {
            // Показване на продукти само от избраната категория
            $products = Product::where('category_id', $categoryId)
                ->where('status', 'Published')
                ->take(8)
                ->get();
        }

        // Връщане на частичен изглед с новите продукти
        return view('extends.product_list', compact('products'))->render();
    }
}
