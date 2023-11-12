<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(): View
    {
        return view('main.account');
    }

    public function updateProfile(Request $request): RedirectResponse
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'required|string|min:6',
        ]);

        $fullName = $request->input('first_name') . ' ' . $request->input('last_name');

        $user = auth()->user();
        $user->update([
            'name' => $fullName,
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('account')
            ->withSuccess('Профилът е актуализиран успешно.');
    }

    public function favorites(): View
    {
        $userId = Auth::user()->id;

        $favoriteProductIds = Favorite::where('user', $userId)->pluck('product')->toArray();

        $products = Product::whereIn('id', $favoriteProductIds)->paginate(8);
        $products->appends(request()->query());

        return view('main.favorites', compact('products'));
    }

    public function makeFavorites($id): RedirectResponse
    {
        $products = Product::findOrFail($id);

        $favorites = Favorite::where('user', Auth::user()->id)->get();

        foreach ($favorites as $favorite){
            if ($favorite->product == $products->id){
                return redirect()->route('favorites')
                    ->withErrors('Продукта вече е в любими.');
            }
        }
        if ($products->id)
        Favorite::create([
           'user' => Auth::user()->id,
            'product' => $products->id
        ]);

        return redirect()->route('favorites')
            ->withSuccess('Добавихте продукта към любими.');
    }

    public function orders(): View
    {
        $userId = Auth::user()->id;

        $orderedProducts = Order::where('user_id', $userId)->pluck('products')->toArray();

        if (empty($orderedProducts)) {
            $products = Product::whereIn('id', $orderedProducts)->paginate(8);
            $products->appends(request()->query());
            return view('main.orders', compact('products'));
        }

        $decodedOrderedProducts = array_map(function ($product) {
            return json_decode($product, true);
        }, $orderedProducts);


        $productNames = collect($decodedOrderedProducts[0])->pluck('product')->toArray();

        $products = Product::whereIn('name', $productNames)->paginate(8);
        $products->appends(request()->query());

        return view('main.orders', compact('products'));
    }
}
