<div class="row">
    <div class="col-lg-6">
        <div class="discount__content">
            <h6>Код за отстъпка</h6>
            <form wire:submit.prevent="applyDiscount">
                <input wire:model="discountCode" type="text" placeholder="Твоят код за отстъпка">
                <button type="submit" class="site-btn">Въведи</button>
            </form>
        </div>
    </div>
    <div class="col-lg-4 offset-lg-2">
        <div class="cart__total__procced">
            <h6>Количка</h6>
            <ul>
                <li>Междинна сума <span>{{$cart_subtotal}}</span></li>
                @foreach(Cart::content()->take(1) as $cartItem)
                    @if(isset($cartItem->options['discounted']))
                        <li>Намаление <span>{{ $cartItem->options['discounted'] }} лев.</span></li>
                    @endif
                @endforeach
            </ul>
            @if(Cart::content()->count() > 0)
                <a href="{{route('checkout')}}" class="primary-btn">Продължи към плащане</a>
            @else
                <a href="#" class="primary-btn">Продължи към плащане</a>
            @endif
        </div>
    </div>
</div>
