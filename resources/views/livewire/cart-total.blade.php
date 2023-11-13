<div class="col-lg-4 offset-lg-2">
    <div class="cart__total__procced">
        <h6>Количка</h6>
        <ul>
            <li>Междинна сума <span>{{$cart_subtotal}}</span></li>
            <li>Общо <span>{{$cart_total}}</span></li>
        </ul>
        @if(Cart::content()->count() > 0)
        <a href="{{route('checkout')}}" class="primary-btn">Продължи към плащане</a>
        @else
            <a href="#" class="primary-btn">Продължи към плащане</a>
        @endif
    </div>
</div>
