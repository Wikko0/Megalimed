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
                        <a href="/shop/{{$product->category->url}}">{{$product->category->menu}} </a>
                        <span>{{$product->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll">
                            @foreach(ProductHelper::getAllProductImage($product->id) as $i => $value)
                            <a class="pt" href="#product-{{$i}}">
                                <img src="{{asset($value)}}" alt="">
                            </a>
                            @endforeach

                        </div>
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach(ProductHelper::getAllProductImage($product->id) as $i => $value)
                                <img data-hash="product-{{$i}}" class="product__big__img" src="{{asset($value)}}" alt="">
                                  @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3>{{$product->name}} <span>Баркод: {{$product->barcode}}</span></h3>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        {!! ProductHelper::getPriceProductDetails($product->id) !!}
                        <p>{{Str::words($product->description, 15, '...')}}</p>

                        @livewire('cart-product', ['product' => $product])

                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Описание</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Спецификация</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Размери</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <h6>Описание</h6>
                                <p>{{$product->description}}</p>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <h6>Спецификация</h6>
                                <p>{{$product->specification}}</p>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <h6><a href="#" class="calculator-switch">Калкулатур за изчисляване на размера - натисни тук</a></h6>
                                <h6>Таблица с размери за горнището</h6>
                                <img src="{{asset('img/size/size_top.png')}}"  width="250" height="250">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Размер</th>
                                        <th scope="col">Дължина на горнището (A)</th>
                                        <th scope="col">Ширина на горнището (B)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($calculatorProvider as $i => $calculator)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$calculator->size}}</td>
                                        <td>{{$calculator->lengthTop}}</td>
                                        <td>{{$calculator->widthTop}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <h6>Таблица с размери за долнището</h6>
                                <img src="{{asset('img/size/size_bot.png')}}" width="250" height="250">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Размер</th>
                                        <th scope="col">Ширина на долнището (C)</th>
                                        <th scope="col">Дължина на долнището (D)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($calculatorProvider as $i => $calculator)
                                        <tr>
                                            <th scope="row">{{$i++}}</th>
                                            <td>{{$calculator->size}}</td>
                                            <td>{{$calculator->widthBot}}</td>
                                            <td>{{$calculator->lengthBot}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Services Section Begin -->
    @include('extends.servicesSection')
    <!-- Services Section End -->

@endsection
