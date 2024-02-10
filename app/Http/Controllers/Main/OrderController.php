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
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class OrderController extends Controller
{
    private function validateFormData($formData): array
    {
        return Validator::make($formData, [
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
            'address.string' => 'Еконт трябва да бъде текст.',
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
        ])->validate();
    }

    public function index(): View
    {
        $subtotalString = Cart::subtotal();
        $subtotalString = str_replace('.00', '', $subtotalString);
        $subtotalString = str_replace(',', '', $subtotalString);
        $cartTotal = floatval($subtotalString) + 6.99;
        return view('main.order', ['cartTotal' => $cartTotal]);
    }

    public function makeCheckout(Request $request)
    {

        $data = $request->input('data');

        parse_str($data, $formData);

        $this->validateFormData($formData);

        $orderItems = collect();
        for ($i = 0; $i < count($formData['product']); $i++) {
            $orderItems->push([
                'product' => $formData['product'][$i],
                'quantity' => $formData['quantity'][$i],
                'price' => $formData['price'][$i],
                'size' => $formData['size'][$i],
                'color' => $formData['color'][$i],
            ]);
        }


        $order = new Order([
            'first_name' => $formData['first_name'],
            'last_name' => $formData['last_name'],
            'country' => $formData['country'],
            'address' => $formData['address'],

            'city' => $formData['city'],
            'post_code' => $formData['post_code'],
            'number' => $formData['number'],
            'email' => $formData['email'],
            'note' => $formData['note'],

            'products' => $orderItems->toJson(),

            'status' => 'Awaiting approval',
        ]);

        if ($formData['password'] !== 'no'){
            $fullName = $formData['first_name'] . ' ' . $formData['last_name'];

            $user = User::create([
                'name' => $fullName,
                'email' => $formData['email'],
                'password' => Hash::make($formData['password']),
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
        return response()->json(['url'=>url('/checkout/success')]);
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
