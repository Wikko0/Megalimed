<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use mysql_xdevapi\Collection;

class CartTable extends Component
{

    public $listeners = ['cart_table' => 'render'];

    public function decrementQuantity($rowId)
    {

        if (Cart::content()->has($rowId)) {
            $product = Cart::get($rowId);
            $qty = $product->qty - 1;

            if ($qty > 0) {
                Cart::update($rowId, $qty);
            } else {
                Cart::remove($rowId);
            }

            $this->emit('cart_total');
        } else {
            session()->flash('error', 'Продуктът не беше намерен в количката.');
            $this->emit('refreshPage');
        }
    }

    public function incrementQuantity($rowId)
    {

        if (Cart::content()->has($rowId)) {
            $product = Cart::get($rowId);
            $qty = $product->qty + 1;

            Cart::update($rowId, $qty);
            $this->emit('cart_total');
        } else {
            session()->flash('error', 'Продуктът не беше намерен в количката.');
            $this->emit('refreshPage');
        }
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
