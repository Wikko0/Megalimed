@extends('layouts.default')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <h5>Успешно!</h5>
            <ul>{{ session('success') }}</ul>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-warning alert-dismissible">
            <h5>Грешка!</h5>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Начало</a>
                        <span>Кошница</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="checkout spad">
        <div class="container">
            <form id="form-data" class="checkout__form" method="POST" action="{{ route('checkout.form') }}">
                @csrf

                {{-- Скрити полета за Еконт --}}
                <input type="hidden" name="customerInfo[id]" id="customerInfo_id">
                <input type="hidden" name="name" id="name">
                <input type="hidden" name="email" id="email">
                <input type="hidden" name="number" id="number">
                <input type="hidden" name="post_code" id="post_code">
                <input type="hidden" name="country" id="country">
                <input type="hidden" name="city" id="city">
                <input type="hidden" name="address" id="address">
                <input type="hidden" name="office_code" id="office_code">
                <input type="hidden" name="shipping_price" id="shipping_price_input">
                <input type="hidden" name="shipping_currency" id="shipping_currency_input">

                <div class="row">
                    <div class="col-lg-8">
                        <h5>Адрес за фактуриране</h5>
                        <div class="row">
                            <iframe
                                title="Econt Office Locator"
                                allow="geolocation;"
                                src="{{ $iframeUrl }}"
                                style="width: 100%; height: 90vh; border-width: 0px;"
                            ></iframe>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="checkout__order">
                            <h5>Твоята поръчка</h5>
                            <div class="checkout__order__product">
                                <ul>
                                    <li>
                                        <span class="top__text">Продукт</span>
                                        <span class="top__text__right">Общо</span>
                                    </li>
                                    @foreach(Cart::content() as $item)
                                        <li>{{ $loop->iteration }}. {{ $item->name }} <span>{{ $item->price }} лв.</span></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="checkout__order__total">
                                <ul>
                                    <li>Междинна сума <span id="subtotal">{{ \Cart::subTotal() }} лв.</span></li>
                                    @foreach(Cart::content()->take(1) as $cartItem)
                                        @if(isset($cartItem->options['discounted']))
                                            <li>Намаление <span>{{ $cartItem->options['discounted'] }} лв.</span></li>
                                        @endif
                                    @endforeach
                                    <li>Общо <span id="shipping-price">... лв.</span></li>
                                </ul>
                            </div>

                            @if(Cart::count() > 0)
                                @foreach(Cart::content() as $cartItem)
                                    <input type="hidden" name="product[]" value="{{ $cartItem->name }}">
                                    <input type="hidden" name="quantity[]" value="{{ $cartItem->qty }}">
                                    <input type="hidden" name="price[]" value="{{ $cartItem->price }}">
                                    <input type="hidden" name="size[]" value="{{ $cartItem->options['size'] }}">
                                    <input type="hidden" name="color[]" value="{{ $cartItem->options['color'] }}">
                                @endforeach
                                <button type="submit" class="site-btn submit-form" id="submitBtn" disabled>Първо потвърди формата</button>
                            @else
                                <div class="site-btn">Няма налични продукти</div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @include('extends.servicesSection')
@endsection

@section('scripts')
    <script>
        window.addEventListener('message', function (message) {
            const data = message.data;

            if (!data || !data.id) return;

            if (data.shipment_error && data.shipment_error !== '') {
                alert('Възникна грешка при изчисляване на стойността на пратката');
                return;
            }

            // Изчисляване на цена
            let price = data.shipping_price;
            const currency = data.shipping_price_currency || 'лв';

            // Попълване на скритите полета
            document.getElementById('customerInfo_id').value = data.id || '';
            document.getElementById('name').value = data.name || '';
            document.getElementById('email').value = data.email || '';
            document.getElementById('number').value = data.phone || '';
            document.getElementById('post_code').value = data.post_code || '';
            document.getElementById('country').value = data.id_country || '';
            document.getElementById('city').value = data.city_name || '';
            document.getElementById('address').value = data.address || '';
            document.getElementById('office_code').value = data.office_code || '';
            document.getElementById('shipping_price_input').value = price;
            document.getElementById('shipping_currency_input').value = currency;

            // Обновяване на тотал
            const subtotalText = document.getElementById('subtotal').textContent.replace(' лв.', '').replace(',', '.');
            const total = (parseFloat(subtotalText) + parseFloat(price)).toFixed(2);
            document.getElementById('shipping-price').textContent = total + ' ' + currency;

            // Активиране на бутона
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = false;
            submitBtn.textContent = 'Потвърди поръчката';
        }, false);
    </script>
@endsection
