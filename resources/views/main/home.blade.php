@extends('layouts.default')

@section('meta_og')
    <meta property="og:title" content="Медицински екипи и дрехи от Megalimed">
    <meta property="og:description" content="Онлайн магазин за модерни и качествени медицински екипи, дрехи и униформи. Дамски и мъжки модели за медицински персонал.">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:site_name" content="Megalimed">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('img/megalimed.jpg') }}">
@endsection

@section('content')
    <h1 class="visually-hidden">Медицински екипи и униформи - Онлайн магазин Megalimed</h1>
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
                        <div class="categories__item categories__large__item"
                             onclick="window.location.href='{{ url('shop/'.$values->url) }}';"
                             role="img"
                             aria-label="{{ $values->name }} - {{ $values->description }}">

                            <img src="{{ asset($values->image) }}"
                                 alt="{{ $values->name }}"
                                 decoding="async"
                                 loading="{{ $loop->first ? 'eager' : 'lazy' }}" />

                            <div class="categories__text">
                                <h2>{{ $values->name }}</h2>
                                <p>{{ $values->description }}</p>
                                <a href="{{ url('shop/'.$values->url) }}">Купете сега</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-lg-6">
                    <div class="row">
                        @foreach($categoryProvider->take(4) as $values)
                            <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                                <div class="categories__item"
                                     onclick="window.location.href='{{ url('shop/' . $values->url) }}';"
                                     role="img"
                                     aria-label="{{ $values->name }} - {{ $values->description }}">

                                    <img class="categories__img"
                                         src="{{ asset($values->image) }}"
                                         alt="{{ $values->name }}"
                                         loading="lazy"
                                         decoding="async" />

                                    <div class="categories__text">
                                        <h4>{{ $values->name }}</h4>
                                        <a href="{{ url('shop/' . $values->url) }}">Купете сега</a>
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
                        <li class="active" data-filter="*" data-category="all">Всички</li>
                        @foreach($categoryProvider as $value)
                            <li data-filter=".{{$value->url}}" data-category="{{$value->id}}">{{$value->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row property__gallery" id="product-list">

                @foreach($productProvider->take(8)->where('status', 'Published') as $value)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $value->category->url }}">
                        <div class="product__item">
                            <div class="product__item__pic set-bg product-image"
                                 data-setbg="{{ ProductHelper::getFirstProductImage($value->id) }}"
                                 data-product-url="/product/{{ $value->slug }}"
                                 data-product-image="{{ ProductHelper::getSecondProductImage($value->id) }}"
                                 role="img"
                                 aria-label="{{ $value->name }}">

                                {!! ProductHelper::getProductLabel($value->id) !!}

                                <img src="{{ ProductHelper::getFirstProductImage($value->id) }}" alt="{{ $value->name }}" loading="lazy" style="position:absolute; width:1px; height:1px; overflow:hidden; clip:rect(1px, 1px, 1px, 1px); clip-path: inset(50%); border:0;" aria-hidden="false" />

                                <ul class="product__hover">
                                    <li>
                                        <a href="{{ ProductHelper::getFirstProductImage($value->id) }}" class="image-popup" aria-label="Увеличи изображение на продукт">
                                            <span class="arrow_expand"></span>
                                        </a>
                                    </li>
                                    @if(Auth::user())
                                        <li><a href="{{ route('make.favorites', [$value->id]) }}"><span class="icon_heart_alt"></span></a></li>
                                    @endif
                                    <li>
                                        <a href="/product/{{ $value->slug }}" aria-label="Преглед на продукт">
                                            <span class="icon_bag_alt"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="/product/{{ $value->slug }}" aria-label="Преглед на продукт">{{ $value->name }}</a></h6>
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
    <section class="banner set-bg" data-setbg="{{ asset('img/banner/banner-1.jpg') }}" aria-label="Колекция медицинско облекло - Елегантни манти и екипи">

        <img src="{{ asset('img/banner/banner-1.jpg') }}" alt="Колекция медицинско облекло - Елегантни манти и екипи" loading="lazy" style="position:absolute; width:1px; height:1px; clip:rect(0 0 0 0); clip-path: inset(50%); overflow:hidden; border:0;" aria-hidden="false" />

        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8 m-auto">
                    <div class="banner__slider owl-carousel">
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>Колекция медицинско облекло</span>
                                <h2>Елегантни манти и екипи</h2>
                                <a href="{{ route('shop') }}">Купете сега</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>Колекция медицински обувки</span>
                                <h2>Удобните скраб обувки</h2>
                                <a href="{{ route('shop') }}">Купете сега</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>Колекция медицински аксесоари</span>
                                <h2>Привлекателни аксесоари</h2>
                                <a href="{{ route('shop') }}">Купете сега</a>
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
                                <a href="/product/{{$value->slug}}"><img src="{{ProductHelper::getFirstProductImage($value->id)}}" alt="Продукт {{$value->name}} - Тренд медицинско облекло" width="90" height="auto" loading="lazy"></a>
                            </div>
                            <div class="trend__item__text">
                                <h6><a href="/product/{{$value->slug}}" aria-label="Преглед на продукт">{{$value->name}}</a></h6>
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
                                    <a href="/product/{{$value->slug}}"><img src="{{ProductHelper::getFirstProductImage($value->id)}}" alt="Бестселър {{$value->name}} - Бестселър медицинско облекло" width="90" height="auto" loading="lazy"></a>
                                </div>
                                <div class="trend__item__text">
                                    <h6><a href="/product/{{$value->slug}}">{{$value->name}}</a></h6>
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
                                    <a href="/product/{{$value->slug}}"><img src="{{ProductHelper::getFirstProductImage($value->id)}}" alt="Препоръчани {{$value->name}} - медицинско облекло" width="90" height="auto" loading="lazy"></a>
                                </div>
                                <div class="trend__item__text">
                                    <h6><a href="/product/{{$value->slug}}">{{$value->name}}</a></h6>
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
                        <img src="{{asset('img/discount.jpg')}}" alt="Намаление - {{$discountProvider->name}}">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="discount__text">
                        <div class="discount__text__title">
                            <span>Намаление</span>
                            <h2>{{$discountProvider->name}}</h2>
                            <h5><span>Разпродажба</span> {{$discountProvider->percent}}%</h5>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function initializeScripts() {
                $('.set-bg').each(function() {
                    var bg = $(this).data('setbg');
                    $(this).css('background-image', 'url(' + bg + ')');
                });

            }


            initializeScripts();

            $('.filter__controls li').click(function() {
                var categoryId = $(this).data('category');
                $('.filter__controls li').removeClass('active');
                $(this).addClass('active');

                $.ajax({
                    url: '/get-products-by-category',
                    method: 'GET',
                    data: {
                        category_id: categoryId
                    },
                    success: function(response) {

                        $('#product-list').html(response);

                        initializeScripts();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

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
