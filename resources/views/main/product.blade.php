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
                        <a href="/"><i class="fa fa-home"></i> Home</a>
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
                        <h3>{{$product->name}} <span>Barcode: {{$product->barcode}}</span></h3>
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
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <h6>Description</h6>
                                <p>{{$product->description}}</p>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <h6>Specification</h6>
                                <p>{{$product->specification}}</p>
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
@section('scripts')
    <script>
        $(document).ready(function () {
            var rangeSlider = $(".price-range"),
                minamount = $("#minamount"),
                maxamount = $("#maxamount"),
                minPrice = rangeSlider.data('min'),
                maxPrice = rangeSlider.data('max');


            rangeSlider.slider({
                range: true,
                min: minPrice,
                max: maxPrice,
                values: [minPrice, maxPrice],
                slide: function (event, ui) {
                    minamount.val('$' + ui.values[0]);
                    maxamount.val('$' + ui.values[1]);
                }
            });


            $("#filter-button").on("click", function (event) {
                event.preventDefault();


                var minPriceValue = rangeSlider.slider("values", 0);
                var maxPriceValue = rangeSlider.slider("values", 1);


                $(".product__item").each(function () {
                    var productPrice = parseFloat($(this).find(".product__price").text().replace('$', '').trim());

                    if (productPrice < minPriceValue || productPrice > maxPriceValue) {
                        $(this).closest(".col-lg-4.col-md-6").remove();
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            function filterProducts(selectedValues, productDataKey) {
                var productData = productDataKey === 'size' ? 'size' : 'color';

                if (selectedValues.length === 0) {
                    $('.product__item').parent().show();
                    return;
                }

                $('.product__item').each(function() {
                    var productDataStr = JSON.parse($(this).data(productData));
                    var productDataArray = JSON.parse(productDataStr);
                    var showProduct = false;

                    for (var i = 0; i < selectedValues.length; i++) {
                        var selectedValue = selectedValues[i];
                        for (var j = 0; j < productDataArray.length; j++) {
                            if (productDataArray[j] === selectedValue) {
                                showProduct = true;
                                break;
                            }
                        }
                        if (showProduct) {
                            break;
                        }
                    }

                    if (showProduct) {
                        $(this).parent().show();
                    } else {
                        $(this).parent().hide();
                    }
                });
            }

            $('.size-checkbox').change(function() {
                var selectedSizes = [];
                $('.size-checkbox:checked').each(function() {
                    selectedSizes.push($(this).attr('id'));
                });
                filterProducts(selectedSizes, 'size');
            });

            $('.color-checkbox').change(function() {
                var selectedColors = [];
                $('.color-checkbox:checked').each(function() {
                    selectedColors.push($(this).attr('id'));
                });
                filterProducts(selectedColors, 'color');
            });
        });
    </script>



@endsection
