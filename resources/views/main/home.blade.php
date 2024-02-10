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
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0 categories__slider owl-carousel">
                    @foreach($categoryProvider as $values)
                    <div class="categories__item categories__large__item set-bg"
                         data-setbg="{{asset($values->image)}}">
                        <div class="categories__text">
                            <h1>{{$values->name}}</h1>
                            <p>{{$values->description}}</p>
                            <a href="shop/{{$values->url}}">Купете сега</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        @foreach($categoryProvider->take(4) as $values)
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="{{asset($values->image)}}">
                                <div class="categories__text">
                                    <h4>{{$values->name}}</h4>
                                    <a href="shop/{{$values->url}}">Купете сега</a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="section-title">
                        <h4>Нови продукти</h4>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">Всички</li>
                        @foreach($categoryProvider as $value)
                            <li data-filter=".{{$value->url}}"> {{$value->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row property__gallery">
                @foreach($productProvider->take(8)->where('status', 'Published') as $value)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{$value->category->url}}">
                        <div class="product__item">

                                <div class="product__item__pic set-bg product-image" data-setbg="{{ProductHelper::getFirstProductImage($value->id)}}" data-product-url="/product/{{$value->id}}" data-product-image="{{ProductHelper::getSecondProductImage($value->id)}}">
                                {!! ProductHelper::getProductLabel($value->id) !!}
                                <ul class="product__hover">
                                    <li><a href="{{ProductHelper::getFirstProductImage($value->id)}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    @if(Auth::user())
                                        <li><a href="{{route('make.favorites', [$value->id])}}"><span class="icon_heart_alt"></span></a></li>

                                    @else
                                        <li><a href="#"><span class="icon_heart_alt account-switch"></span></a></li>
                                    @endif
                                    <li>
                                        <a href="/product/{{$value->id}}">
                                            <span class="icon_bag_alt"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="/product/{{$value->id}}">{{$value->name}}</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                {!! ProductHelper::getPriceHtml($value->id) !!}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </section>



    <!-- Product Section End -->

    <!-- Banner Section Begin -->
    <section class="banner set-bg" data-setbg="{{asset('img/banner/banner-1.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8 m-auto">
                    <div class="banner__slider owl-carousel">
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>Колекция медицинско облекло</span>
                                <h1>Елегантни манти и екипи</h1>
                                <a href="{{route('shop')}}">Купете сега</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>Колекция медицински обувки</span>
                                <h1>Удобните скраб обувки</h1>
                                <a href="{{route('shop')}}">Купете сега</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>Колекция медицински аксесоари</span>
                                <h1>Привлекателни аксесоари</h1>
                                <a href="{{route('shop')}}">Купете сега</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Trend Section Begin -->
    <section class="trend spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Тренд</h4>
                        </div>
                        @foreach($productProvider->shuffle()->take(3)->where('status', 'Published') as $value)
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <a href="/product/{{$value->id}}"><img src="{{ProductHelper::getFirstProductImage($value->id)}}" alt="Trend {{$value->name}}" width="90" height="90"></a>
                            </div>
                            <div class="trend__item__text">
                                <h6><a href="/product/{{$value->id}}">{{$value->name}}</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                {!! ProductHelper::getPriceHtml($value->id) !!}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Бестселъри</h4>
                        </div>

                        @foreach($productProvider->shuffle()->take(3)->where('status', 'Published') as $value)
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    <a href="/product/{{$value->id}}"><img src="{{ProductHelper::getFirstProductImage($value->id)}}" alt="Trend {{$value->name}}" width="90" height="90"></a>
                                </div>
                                <div class="trend__item__text">
                                    <h6><a href="/product/{{$value->id}}">{{$value->name}}</a></h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    {!! ProductHelper::getPriceHtml($value->id) !!}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Които може да ти харесат</h4>
                        </div>

                        @foreach($recommendedProducts as $value)
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    <a href="/product/{{$value->id}}"><img src="{{ProductHelper::getFirstProductImage($value->id)}}" alt="Trend {{$value->name}}" width="90" height="90"></a>
                                </div>
                                <div class="trend__item__text">
                                    <h6><a href="/product/{{$value->id}}">{{$value->name}}</a></h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    {!! ProductHelper::getPriceHtml($value->id) !!}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Trend Section End -->

    @if(!empty($discountProvider->status) && $discountProvider->status == 'on')
    <!-- Discount Section Begin -->
    <section class="discount">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="discount__pic">
                        <img src="{{asset('img/discount.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="discount__text">
                        <div class="discount__text__title">
                            <span>Намаление</span>
                            <h2>Лято 2023</h2>
                            <h5><span>Разпродажба</span> 50%</h5>
                        </div>
                        <div class="discount__countdown" id="countdown-time">
                            <div class="countdown__item">
                                <span>22</span>
                                <p>Дни</p>
                            </div>
                            <div class="countdown__item">
                                <span>18</span>
                                <p>Часа</p>
                            </div>
                            <div class="countdown__item">
                                <span>46</span>
                                <p>Минути</p>
                            </div>
                            <div class="countdown__item">
                                <span>05</span>
                                <p>Секунди</p>
                            </div>
                        </div>
                        <a href="{{route('shop')}}">Купете сега</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Discount Section End -->
    @endif

    <!-- Services Section Begin -->
    @include('extends.servicesSection')
    <!-- Services Section End -->

@endsection

@if(!empty($discountProvider->status) && $discountProvider->status == 'on')

    @section('scripts')
        <script>

            var discountData = "{{\Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $discountProvider->date)->format('m/d/Y H:i:s')}}";

            $("#countdown-time").countdown(discountData, function(event) {
                $(this).html(event.strftime("<div class='countdown__item'><span>%D</span> <p>Day</p> </div>" + "<div class='countdown__item'><span>%H</span> <p>Hour</p> </div>" + "<div class='countdown__item'><span>%M</span> <p>Min</p> </div>" + "<div class='countdown__item'><span>%S</span> <p>Sec</p> </div>"));
            });
        </script>
    @endsection

@endif
