<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartTotal extends Component
{
    public $listeners = ['cart_total' => 'render'];
    public $cart;
    public function render()
    {
        $this->cart = Cart::total();
        return view('livewire.cart-total', ['cart' => $this->cart]);
    }
}
