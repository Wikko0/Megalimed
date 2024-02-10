<?php

namespace App\Http\Livewire;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CartProduct extends Component
{
    public $product;
    public $quantity = 1;
    public $selectedColor;
    public $selectedSize;
    public $showCartPopup = false;


    public function mount($product)
    {
        $this->product = $product;
    }

    public function setSelectedColor($color)
    {
        $this->selectedColor = $color;
    }

    public function setSelectedSize($size)
    {
        $this->selectedSize = $size;
    }

    public function addToCart()
    {
        $this->validate(
            [
                'quantity' => 'required|integer|min:1',
                'selectedColor' => 'required',
                'selectedSize' => 'required',
            ],
            [
                'quantity.required' => 'Моля, въведете количество.',
                'quantity.integer' => 'Количеството трябва да бъде цяло число.',
                'quantity.min' => 'Количеството трябва да бъде поне 1.',
                'selectedColor.required' => 'Моля, изберете цвят.',
                'selectedSize.required' => 'Моля, изберете размер.',
            ]
        );

        $product = Product::findOrFail($this->product->id);

        if ($product->discount) {
            $price = $product->discount;
        } else {
            $price = $product->price;
        }

        Cart::add($product->id, $product->name, $this->quantity, $price, [
            'color' => $this->selectedColor,
            'size' => $this->selectedSize,
        ], 0);

        $this->showCartPopup = true;

        $this->emit('cart_updated');
    }

    public function render()
    {
        $stock = json_decode($this->product->stock, true);
        $stockKey = $this->selectedColor . '-' . $this->selectedSize;
        $stockQuantity = $stock[$stockKey] ?? 'Няма в наличност';

        $sizes = json_decode($this->product->size);
        usort($sizes, function ($a, $b) {
            $order = ['XXS', 'XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
            return array_search($a, $order) - array_search($b, $order);
        });

        if ($stockQuantity !== 'Няма в наличност' && $this->quantity > $stockQuantity) {
            $stockQuantity = 'Няма в наличност';
        }

        return view('livewire.cart-product', [
            'stockQuantity' => $stockQuantity,
            'sizes' => $sizes,
        ]);
    }
}
