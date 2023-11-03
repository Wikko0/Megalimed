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
                            <a href="shop/{{$values->url}}">Shop now</a>
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
                                    <p>358 items</p>
                                    <a href="shop/{{$values->url}}">Shop now</a>
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
                        <h4>New product</h4>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">All</li>
                        @foreach($categoryProvider as $value)
                            <li data-filter=".{{$value->url}}"> {{$value->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row property__gallery">
                @foreach($productProvider->take(8) as $value)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{$value->category->url}}">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ProductHelper::getFirstProductImage($value->id)}}">
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
                                <h6><a href="#">{{$value->name}}</a></h6>
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
                                <span>The Medical Attire Collection</span>
                                <h1>The Professional Lab Coat</h1>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Medical Footwear Collection</span>
                                <h1>The Comfortable Scrub Shoes</h1>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Medical Accessories Collection</span>
                                <h1>The Essential Stethoscope</h1>
                                <a href="#">Shop now</a>
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
                            <h4>Hot Trend</h4>
                        </div>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="{{asset('img/trend/ht-1.jpg')}}" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6>Medical Suits</h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 59.0</div>
                            </div>
                        </div>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="{{asset('img/trend/ht-2.jpg')}}" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6>Medical Suits</h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 59.0</div>
                            </div>
                        </div>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="{{asset('img/trend/ht-3.jpg')}}" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6>Medical Suits</h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 59.0</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Best seller</h4>
                        </div>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="{{asset('img/trend/bs-1.jpg')}}" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6>Medical Suits</h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 59.0</div>
                            </div>
                        </div>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="{{asset('img/trend/bs-2.jpg')}}" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6>Medical Suits</h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 59.0</div>
                            </div>
                        </div>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="{{asset('img/trend/bs-3.jpg')}}" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6>Medical Suits</h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 59.0</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Feature</h4>
                        </div>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="{{asset('img/trend/f-1.jpg')}}" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6>Medical Suits</h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 59.0</div>
                            </div>
                        </div>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="{{asset('img/trend/f-2.jpg')}}" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6>Medical Suits</h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 59.0</div>
                            </div>
                        </div>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="{{asset('img/trend/f-3.jpg')}}" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6>Medical Suits</h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 59.0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Trend Section End -->

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
                            <span>Discount</span>
                            <h2>Summer 2023</h2>
                            <h5><span>Sale</span> 50%</h5>
                        </div>
                        <div class="discount__countdown" id="countdown-time">
                            <div class="countdown__item">
                                <span>22</span>
                                <p>Days</p>
                            </div>
                            <div class="countdown__item">
                                <span>18</span>
                                <p>Hour</p>
                            </div>
                            <div class="countdown__item">
                                <span>46</span>
                                <p>Min</p>
                            </div>
                            <div class="countdown__item">
                                <span>05</span>
                                <p>Sec</p>
                            </div>
                        </div>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Discount Section End -->

    <!-- Services Section Begin -->
    @include('extends.servicesSection')
    <!-- Services Section End -->

@endsection
