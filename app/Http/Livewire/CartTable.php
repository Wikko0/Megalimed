<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use mysql_xdevapi\Collection;

class CartTable extends Component
{

    public function decrementQuantity($rowId)
    {
        $product = Cart::get($rowId);

        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);

        $this->emit('cart_total');
    }

    public function incrementQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);

        $this->emit('cart_total');
    }

    public function deleteProduct($rowId)
    {
        Cart::remove($rowId);

        $this->emit('cart_table_updated');
        $this->emit('cart_total');
    }

    public function render()
    {
        return view('livewire.cart-table');
    }
}
