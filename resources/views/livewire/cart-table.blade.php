<tbody>
@forelse(Cart::content() as $cartItem)
    <tr>
        <td class="cart__product__item">
            <img src="{{ProductHelper::getFirstProductImage($cartItem->id)}}" alt="" width="90" height="90">
            <div class="cart__product__item__title">
                <h6><a href="/product/{{$cartItem->id}}">{{$cartItem->name}}</a></h6>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
            </div>
        </td>
        <td class="cart__price">
            {{ $cartItem->price }} лв.
            <span class="text-muted" style="font-size: 0.8em;">
        ({{ number_format($cartItem->price / 1.9558, 2) }} €)
    </span>
        </td>
        <td class="cart__size">{{$cartItem->options['size']}}</td>
        <td class="cart__color">{{$cartItem->options['color']}}</td>
        <td class="cart__quantity">
            <div class="pro-qty">
                <span class="dec qtybtn" wire:click="decrementQuantity('{{ $cartItem->rowId }}')">-</span>
                <input value="{{$cartItem->qty}}" type="text">
                <span class="inc qtybtn" wire:click="incrementQuantity('{{ $cartItem->rowId }}')">+</span>
            </div>
        </td>
        <td class="cart__total">
            {{ round($cartItem->price * $cartItem->qty, 2) }} лв.
            <span class="text-muted" style="font-size: 0.85em;">
        ({{ number_format(round($cartItem->price * $cartItem->qty, 2) / 1.9558, 2) }} €)
    </span>
        </td>
        <td class="cart__close"><span wire:click.prevent="deleteProduct('{{ $cartItem->rowId }}')" class="icon_close"></span></td>
    </tr>
    @empty
    <tr>
        <td>
            Няма продукти в количката
        </td>
    </tr>
@endforelse
</tbody>
