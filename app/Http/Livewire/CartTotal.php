<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;


class CartTotal extends Component
{
    public $listeners = ['cart_total' => 'render'];
    public $cart_total;
    public $cart_subtotal;
    public $discountCode;
    public $discountAmount;


    public function render()
    {
        $cartCount = Cart::content()->sum('qty');

        if ($cartCount >= 5) {
            Cart::content()->each(function ($item, $rowId) use ($cartCount) {

                $discountAmount = floatval(2);
                $totalDiscount = $discountAmount * $cartCount;

                if (empty($item->options['discounted'])) {
                    $newPrice = $item->price - $discountAmount;
                } else {
                    $newPrice = $item->price;
                }


                $currentOptions = $item->options;
                $currentOptions['discounted'] = $totalDiscount;

                Cart::update($rowId, ['price' => $newPrice, 'options' => $currentOptions]);
                });
        } else {
            Cart::content()->each(function ($item, $rowId) {
                if (!empty($item->options['discounted'])) {
                    $discountAmount = floatval($item->options['discounted']);

                    $newPrice = $item->price + $discountAmount;

                    $currentOptions = $item->options;
                    unset($currentOptions['discounted']);

                    Cart::update($rowId, ['price' => $newPrice, 'options' => $currentOptions]);
                }
            });
        }

        $this->emit('render');
        $this->emit('cart_table');

        $subtotalString = Cart::subtotal();
        $subtotalString = str_replace('.00', '', $subtotalString);
        $subtotalString = str_replace(',', '', $subtotalString);
        $this->cart_total = floatval($subtotalString) + 6.99;
        $this->cart_subtotal = Cart::subtotal();

        return view('livewire.cart-total', ['cart_total' => $this->cart_total, 'cart_subtotal' => $this->cart_subtotal]);
    }


    public function applyDiscount()
    {

        if ($this->discountCode === 'MEGALIMED6') {

            $cartItems = Cart::content();



            $cartItems->each(function ($item, $rowId) {
                if (empty($item->options['discounted'])){
                $subtotalString = Cart::subtotal();
                $subtotalString = str_replace('.00', '', $subtotalString);
                $subtotalString = str_replace(',', '', $subtotalString);
                $discountAmount = (floatval($subtotalString) * 6) / 100;

                $newPrice = $item->price - $discountAmount;


                $currentOptions = $item->options;
                $currentOptions['discounted'] = $discountAmount;


                Cart::update($rowId, ['price' => $newPrice, 'options' => $currentOptions]);

                }
            });


            $this->emit('render');
            $this->emit('cart_table');
        }
    }
}
