@extends('layouts.default')
@section('content')
    <h1 class="visually-hidden">Купи {{$product->name}} от Megalimed</h1>
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
                        <a href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i> Начало</a>
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
                                <a class="pt" href="javascript:void(0);" data-index="{{$i}}">
                                    <img src="{{asset($value)}}" alt="Снимка {{$i + 1}} на продукт {{ $product->name }}">
                                </a>
                            @endforeach
                        </div>
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach(ProductHelper::getAllProductImage($product->id) as $i => $value)
                                    <a href="{{asset($value)}}" class="image-popup" aria-label="Увеличи изображение на продукт {{$product->name}}">
                                        <img class="product__big__img" src="{{asset($value)}}" alt="Голяма снимка на продукт {{ $product->name }}, снимка {{$i + 1}}">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3>{{$product->name}} <span>Баркод: {{$product->barcode}}</span></h3>
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
                                <img src="{{asset('img/size/size_top.png')}}" alt="Таблица с размери за горнище" width="250" height="250">
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
                                <img src="{{asset('img/size/size_bot.png')}}" alt="Таблица с размери за долнище" width="250" height="250">
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

@section('jsonld')
    <script type="application/ld+json">
        {
          "@context": "https://schema.org/",
          "@type": "Product",
          "name": "{{ $product->name }}",
  "image": [
        @foreach(ProductHelper::getAllProductImage($product->id) as $i => $image)
            "{{ asset($image) }}"@if(!$loop->last),@endif
        @endforeach
        ],
        "description": "{{ Str::limit(strip_tags($product->description), 200) }}",
  "sku": "{{ $product->barcode }}",
  "mpn": "{{ $product->barcode }}",
  "brand": {
    "@type": "Brand",
    "name": "Megalimed"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "BGN",
    "price": "{{ $product->price }}",
    "availability": "{{ $product->stock ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
    "itemCondition": "https://schema.org/NewCondition",
    "priceValidUntil": "{{ \Carbon\Carbon::now()->addMonth()->toDateString() }}",

    "hasMerchantReturnPolicy": {
      "@type": "MerchantReturnPolicy",
      "returnPolicyCategory": "https://schema.org/MerchantReturnFiniteReturnWindow",
      "merchantReturnDays": 14,
      "returnMethod": "https://schema.org/ReturnByMail",
      "returnFees": "https://schema.org/FreeReturn"
    },

    "shippingDetails": {
      "@type": "OfferShippingDetails",
      "shippingRate": {
        "@type": "MonetaryAmount",
        "value": "5.00",
        "currency": "BGN"
      },
      "shippingDestination": {
        "@type": "DefinedRegion",
        "addressCountry": "BG"
      },
      "deliveryTime": {
        "@type": "ShippingDeliveryTime",
        "handlingTime": {
          "@type": "QuantitativeValue",
          "minValue": 0,
          "maxValue": 1,
          "unitCode": "d"
        },
        "transitTime": {
          "@type": "QuantitativeValue",
          "minValue": 1,
          "maxValue": 3,
          "unitCode": "d"
        }
      }
    }
  },

  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5.0",
    "reviewCount": "24"
  },

  "review": [
    {
      "@type": "Review",
      "author": {
        "@type": "Person",
        "name": "Виктор Минчев"
      },
      "datePublished": "2025-06-11",
     "reviewBody": "Медицинските екипи от Megalimed са изключително удобни и с високо качество. Материята е приятна на допир, не се мачка лесно и е подходяща за дълги работни смени. Отлично съотношение между цена и качество, с бърза доставка и коректно обслужване.",
      "name": "Отличен избор",
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": "5",
        "bestRating": "5"
      }
    }
  ]
}
    </script>
@endsection

