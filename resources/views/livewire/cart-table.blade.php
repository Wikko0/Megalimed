<tbody>
@forelse(Cart::content() as $cartItem)
    <tr>
        <td class="cart__product__item">
            <img src="{{ProductHelper::getFirstProductImage($cartItem->id)}}" alt="" width="90" height="90">
            <div class="cart__product__item__title">
                <h6>{{$cartItem->name}}</h6>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
            </div>
        </td>
        <td class="cart__price">{{$cartItem->price}} лев.</td>
        <td class="cart__quantity">
            <div class="pro-qty">
                <span class="dec qtybtn" wire:click="decrementQuantity('{{ $cartItem->rowId }}')">-</span>
                <input value="{{$cartItem->qty}}" type="text">
                <span class="inc qtybtn" wire:click="incrementQuantity('{{ $cartItem->rowId }}')">+</span>
            </div>
        </td>
        <td class="cart__total">{{$cartItem->price * $cartItem->qty}} лев.</td>
        <td class="cart__close"><span wire:click.prevent="deleteProduct('{{ $cartItem->rowId }}')" class="icon_close"></span></td>
    </tr>
    @empty
    <tr>
        <td>
            No item in cart
        </td>
    </tr>
@endforelse
</tbody>
