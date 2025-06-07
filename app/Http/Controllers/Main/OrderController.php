<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmMail;
use App\Models\Order;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class OrderController extends Controller
{
    private function validateFormData($formData): array
    {
        return Validator::make($formData, [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'number' => 'required|string',
            'post_code' => 'nullable|string',
            'country' => 'required|string',
            'city' => 'nullable|string',
            'address' => 'nullable|string',
            'office_code' => 'nullable|string',
            'shipping_price_input' => 'nullable|string',
            'shipping_currency_input' => 'nullable|string',
        ], [
            'name.required' => 'Полето за име е задължително.',
            'name.string' => 'Полето за име трябва да бъде текст.',

            'email.required' => 'Полето за имейл е задължително.',
            'email.string' => 'Полето за имейл трябва да бъде текст.',
            'email.email' => 'Моля, въведи валиден имейл адрес.',

            'number.required' => 'Полето за телефонен номер е задължително.',
            'number.string' => 'Полето за телефонен номер трябва да бъде текст.',

            'post_code.string' => 'Полето за пощенски код трябва да бъде текст.',

            'country.required' => 'Полето за държава е задължително.',
            'country.string' => 'Полето за държава трябва да бъде текст.',

        ])->validate();

    }

    public function index(): View
    {
        $subtotalString = Cart::subtotal();
        $subtotalString = str_replace(['.00', ','], '', $subtotalString);

        $shipmentCalcUrl = Config::get('econt.shipment_calc_url');
        $shopId = Config::get('econt.shop_id');
        $currency = Config::get('econt.shop_currency');


        $totalWeight = Cart::content()->sum(function ($item) {
            return $item->qty * 0.5;
        });
        $params = [
            'id_shop' => $shopId,
            'order_total' => $subtotalString,
            'order_currency' => $currency,
            'order_weight' => $totalWeight,
            'confirm_txt' => 'Потвърди',
            'ignore_history' => 1,
        ];

        $iframeUrl = $shipmentCalcUrl . '?' . http_build_query($params, null, '&');;

        return view('main.order', [
            'iframeUrl' => $iframeUrl,
        ]);
    }

    public function makeCheckout(Request $request)
    {
        $formData = $request->all();
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
            'first_name' => $formData['name'],
            'email' => $formData['email'],
            'number' => $formData['number'],
            'post_code' => $formData['post_code'] ?? null,
            'country' => $formData['country'],
            'city' => $formData['city'] ?? null,
            'address' => trim(($formData['address'] ?? '') . ' ' . ($formData['office_code'] ?? '')),
            'products' => $orderItems->toJson(),
            'status' => 'Awaiting approval',
        ]);

        $order->save();

        if (!empty($formData['email'])) {
            Mail::to($formData['email'])->send(new ConfirmMail($order));
        }

        Cart::destroy();

        return redirect('/checkout/success?order_id=' . $order->id);
    }

    public function successCheckout(Request $request): View|RedirectResponse
    {
        $orderId = $request->query('order_id');

        if (!$orderId || !$order = Order::find($orderId)) {
            return redirect()->route('home')->withErrors(['message' => 'Няма налична поръчка.']);
        }

        return view('main.success', compact('order'));
    }
}
