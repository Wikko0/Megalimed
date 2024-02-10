@extends('layouts.default')
@section('content')

    <!-- Success/ Errors -->
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
    <!-- Success/ Errors End -->
    <!-- Breadcrumb Begin -->
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
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <form id="form-data" class="checkout__form">

                <div class="row">
                    <div class="col-lg-8">
                        <h5>Адрес за фактуриране</h5>
                        <div class="row">
                            @if(Auth::user())
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Име <span>*</span></p>
                                    <div id="first_name_error" class="form-text text-danger"></div>
                                    <input type="text" name="first_name" value="{{ explode(' ', auth()->user()->name)[0]}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Фамилия <span>*</span></p>
                                    <div id="last_name_error" class="form-text text-danger"></div>
                                    <input type="text" name="last_name" value="{{ explode(' ', auth()->user()->name)[1]}}" readonly>
                                </div>
                            </div>
                            @else
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="checkout__form__input">
                                        <p>Име <span>*</span></p>
                                        <div id="first_name_error" class="form-text text-danger"></div>
                                        <input type="text" name="first_name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="checkout__form__input">
                                        <p>Фамилия <span>*</span></p>
                                        <div id="last_name_error" class="form-text text-danger"></div>
                                        <input type="text" name="last_name">
                                    </div>
                                </div>
                            @endif
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Държава <span>*</span></p>
                                    <div id="country_error" class="form-text text-danger"></div>
                                    <input type="text" name="country">
                                </div>
                                    <div class="checkout__form__input">
                                        <p>Изберете вид доставка <span>*</span></p>
                                        <div id="delivery_type_error" class="form-text text-danger"></div>
                                        <select id="delivery_type" name="delivery_type" onchange="toggleDeliveryForm()">
                                            <option value="to_address">До адрес</option>
                                            <option value="to_office">До офис</option>
                                        </select>
                                    </div>
                                <div class="checkout__form__input" id="address_form">
                                    <p>Адрес<span>*</span></p>
                                    <input id="address" type="text" name="address">
                                </div>

                                <div class="col-lg-12" id="office_frame" style="display: none;">
                                    <iframe title="Econt Office Locator"
                                            allow="geolocation;"
                                            src="https://staging.officelocator.econt.com?shopUrl=https://example.staging.officelocator.econt.com&city=Sofia&address=ul. rezbarska 5&officeType=office&lang=bg"
                                            style="width: 100%; height: 90vh; border-width: 0px;"
                                            onload="sendAddressToParent()">
                                    </iframe>
                                </div>
                                <div id="address_error" class="form-text text-danger"></div>
                                <div class="checkout__form__input">
                                    <p>Град<span>*</span></p>
                                    <div id="city_error" class="form-text text-danger"></div>
                                    <input type="text" name="city">
                                </div>
                                <div class="checkout__form__input">
                                    <p>Пощенски код <span>*</span></p>
                                    <div id="post_code_error" class="form-text text-danger"></div>
                                    <input type="number" name="post_code">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">

                                    <p>Мобилен телефон <span>*</span></p>
                                    <div id="number_error" class="form-text text-danger"></div>
                                    <input type="number" name="number">

                                </div>

                            </div>
                                @if(Auth::user())
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="checkout__form__input">
                                            <p>Емайл <span>*</span></p>
                                            <div id="email_error" class="form-text text-danger"></div>
                                            <input type="text" name="email" value="{{Auth::user()->email}}" readonly>
                                            <input type="hidden" name="password" value="no">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                @else
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Емайл <span>*</span></p>
                                    <div id="email_error" class="form-text text-danger"></div>
                                    <input type="text" name="email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__checkbox">
                                    <p>АВТОМАТИЧНО ще ви бъде направена регистрация в нашия сайт с посочения емайл и парола.
                                        </p>
                                </div>
                                <div class="checkout__form__input">
                                    <p>Парола <span>*</span></p>
                                    <div id="passowrd_error" class="form-text text-danger"></div>
                                    <input type="password" name="password">
                                </div>
                                @endif
                                <div class="checkout__form__input">
                                    <p>Допълнителна информация</p>
                                    <input type="text" name="note"
                                           placeholder="Може да напишете допълнителна информация за поръчката">
                                </div>
                            </div>
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
                                            <li>{{ $loop->iteration }}. {{ $item->name }} <span>{{ $item->price }} лев.</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="checkout__order__total">
                                    <ul>
                                        <li>Междинна сума <span>{{ \Cart::subTotal() }} лев.</span></li>
                                        <li>Общо <span>{{ $cartTotal }} лев.</span></li>
                                    </ul>
                                </div>
                                @if(Cart::count() > 0)
                                    @foreach(Cart::content() as $cartItem)
                                        <input type="hidden" name="product[]" value="{{$cartItem->name}}">
                                        <input type="hidden" name="quantity[]" value="{{$cartItem->qty}}">
                                        <input type="hidden" name="price[]" value="{{$cartItem->price}}">
                                        <input type="hidden" name="size[]" value="{{$cartItem->options['size']}}">
                                        <input type="hidden" name="color[]" value="{{$cartItem->options['color']}}">
                                    @endforeach
                                    <button type="button" class="site-btn submit-form" id="create_new">Потвърди поръчката</button>
                                @else
                                    <div class="site-btn">Няма налични продукти</div>
                @endif

            </form>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Services Section Begin -->
    @include('extends.servicesSection')
    <!-- Services Section End -->

@endsection

@section('scripts')

    <script>
        function displayMessage(event) {
            if (event.data?.office === undefined) {
                return;
            }

            const fullAddress = event.data.office.address.fullAddress;
            document.getElementById('address').value = fullAddress;
        }

        if (window.addEventListener) {
            window.addEventListener('message', displayMessage);
        } else {
            window.attachEvent("onmessage", displayMessage);
        }

        $(".submit-form").click(function(e){
            e.preventDefault();
            var data = $('#form-data').serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                contentType: 'application/json',
                processData: false
            });

            $.ajax({
                url: '{{ route('checkout.form') }}',
                method: 'POST',
                data: JSON.stringify({ data }),
                success: function(res){
                    window.location=res.url;
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });
    </script>
    <script>
        function toggleDeliveryForm() {
            var deliveryType = document.getElementById('delivery_type').value;
            var addressForm = document.getElementById('address_form');
            var officeFrame = document.getElementById('office_frame');

            if (deliveryType === 'to_address') {
                addressForm.style.display = 'block';
                officeFrame.style.display = 'none';
            } else {
                addressForm.style.display = 'none';
                officeFrame.style.display = 'block';
            }
        }
    </script>
@endsection
