<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        return view('main.order');
    }

    public function makeCheckout(Request $request): RedirectResponse
    {

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required',
            'country' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'post_code' => 'required|string',
            'number' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'note' => 'nullable|string',
        ], [
            'first_name.required' => 'Полето за име е задължително.',
            'first_name.string' => 'Името трябва да бъде текст.',
            'last_name.required' => 'Полето за фамилия е задължително.',
            'last_name.string' => 'Фамилията трябва да бъде текст.',
            'password.required' => 'Полето за парола е задължително.',
            'country.required' => 'Полето за държава е задължително.',
            'country.string' => 'Държавата трябва да бъде текст.',
            'address.required' => 'Полето за адрес е задължително.',
            'address.string' => 'Адресът трябва да бъде текст.',
            'city.required' => 'Полето за град е задължително.',
            'city.string' => 'Градът трябва да бъде текст.',
            'post_code.required' => 'Полето за пощенски код е задължително.',
            'post_code.string' => 'Пощенският код трябва да бъде текст.',
            'number.required' => 'Полето за телефонен номер е задължително.',
            'number.string' => 'Телефонният номер трябва да бъде текст.',
            'email.required' => 'Полето за имейл е задължително.',
            'email.string' => 'Имейлът трябва да бъде текст.',
            'email.email' => 'Невалиден имейл адрес.',
            'email.max' => 'Имейлът не може да бъде по-дълъг от 255 символа.',
            'email.unique' => 'Този имейл вече се използва от друг потребител.',
            'note.string' => 'Забележката трябва да бъде текст.',
        ]);

        $orderItems = collect();
        for ($i = 0; $i < count($request->input('product')); $i++) {
            $orderItems->push([
                'product' => $request->input('product')[$i],
                'quantity' => $request->input('quantity')[$i],
                'price' => $request->input('price')[$i],
                'size' => $request->input('size')[$i],
                'color' => $request->input('color')[$i],
            ]);
        }


        $order = new Order([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'country' => $request->input('country'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'post_code' => $request->input('post_code'),
            'number' => $request->input('number'),
            'email' => $request->input('email'),
            'note' => $request->input('note'),

            'products' => $orderItems->toJson(),

            'status' => 'Awaiting approval',
        ]);

        if ($request->input('password') !== 'no'){
            $fullName = $request->input('first_name') . ' ' . $request->input('last_name');

            $user = User::create([
                'name' => $fullName,
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            $user->assignRole('user');

            Auth::login($user);

            $order->user_id = $user->id;
        }

        if (Auth::check()) {
            $order->user_id = Auth::user()->id;
        }

        $order->save();

        Cart::destroy();
        return redirect()->route('checkout.success');
    }

    public function successCheckout(): View|RedirectResponse
    {
        if (Auth::check()) {
            $order = Auth::user()->orders()->latest()->first();


            if (!$order) {
                return redirect()->route('home')->withErrors(['message' => 'Няма налична поръчка.']);
            }

            return view('main.success', compact('order'));
        } else {
            return redirect()->route('home')->withErrors( 'Моля, влезте в профила си, за да видите поръчките си.');
        }
    }
}
