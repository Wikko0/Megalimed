<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{

    public function index(): View
    {
        $cart = Cart::content();

        return view('main.cart', compact('cart'));
    }


    public function store($id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        if ($product->discount)
        {
            $price = $product->discount;
        } else {
            $price = $product->price;
        }

        Cart::add($product->id, $product->name, 1, $price);

        return redirect()->route('home')->withSuccess('Успешно добавихте продукта в количката.');
    }
}
