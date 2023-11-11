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
            <form action="{{route('checkout.form')}}" method="POST" class="checkout__form">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Адрес за фактуриране</h5>
                        <div class="row">
                            @if(Auth::user())
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Име <span>*</span></p>
                                    <input type="text" name="first_name" value="{{ explode(' ', auth()->user()->name)[0]}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Фамилия <span>*</span></p>
                                    <input type="text" name="last_name" value="{{ explode(' ', auth()->user()->name)[1]}}" readonly>
                                </div>
                            </div>
                            @else
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="checkout__form__input">
                                        <p>Име <span>*</span></p>
                                        <input type="text" name="first_name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="checkout__form__input">
                                        <p>Фамилия <span>*</span></p>
                                        <input type="text" name="last_name">
                                    </div>
                                </div>
                            @endif
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Държава <span>*</span></p>
                                    <input type="text" name="country">
                                </div>
                                <div class="checkout__form__input">
                                    <p>Адрес <span>*</span></p>
                                    <input type="text" placeholder="Еконт" name="address">
                                </div>
                                <div class="checkout__form__input">
                                    <p>Град<span>*</span></p>
                                    <input type="text" name="city">
                                </div>
                                <div class="checkout__form__input">
                                    <p>Пощенски код <span>*</span></p>
                                    <input type="number" name="post_code">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Мобилен телефон <span>*</span></p>
                                    <input type="number" name="number">
                                </div>
                            </div>
                                @if(Auth::user())
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="checkout__form__input">
                                            <p>Емайл <span>*</span></p>
                                            <input type="text" name="email" value="{{Auth::user()->email}}" readonly>
                                            <input type="hidden" name="password" value="no">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                @else
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Емайл <span>*</span></p>
                                    <input type="text" name="email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__checkbox">
                                    <p>Ще ви бъде направена регистрация в нашия сайт с посочения емайл и парола.
                                        </p>
                                </div>
                                <div class="checkout__form__input">
                                    <p>Парола <span>*</span></p>
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
                                    <li>01. Chain buck bag <span>$ 300.0</span></li>
                                    <li>02. Zip-pockets pebbled<br /> tote briefcase <span>$ 170.0</span></li>
                                    <li>03. Black jean <span>$ 170.0</span></li>
                                    <li>04. Cotton shirt <span>$ 110.0</span></li>
                                </ul>
                            </div>
                            <div class="checkout__order__total">
                                <ul>
                                    <li>Subtotal <span>$ 750.0</span></li>
                                    <li>Total <span>$ 750.0</span></li>
                                </ul>
                            </div>
                            <button type="submit" class="site-btn">Потвърди поръчката</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Services Section Begin -->
    @include('extends.servicesSection')
    <!-- Services Section End -->

@endsection
