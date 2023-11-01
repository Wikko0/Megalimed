<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\View\View;
use Livewire\Component;

class ProductsTable extends Component
{
    public bool $showCartPopup = false;

    public function render(): View
    {

        return view('livewire.products-table');
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount)
        {
            $price = $product->discount;
        } else {
            $price = $product->price;
        }

        Cart::add($product->id, $product->name, 1, $price);

        $this->showCartPopup = true;

        $this->emit('cart_updated');
    }
}
