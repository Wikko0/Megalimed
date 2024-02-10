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
                        <span>Магазин</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4>Категория</h4>
                            </div>
                            <div class="categories__accordion">
                                <div>
                                    @foreach($categoryProvider as $value)
                                    <div class="card">
                                        <div class="card-heading">
                                            <a href="/shop/{{$value->url}}">{{$value->menu}}</a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__filter">
                            <div class="section-title">
                                <h4>Пазарувай по цена</h4>
                            </div>
                            <div class="filter-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                     data-min="1" data-max="300"></div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <p>Цена:</p>
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                            <a href="#" id="filter-button">Филтър</a>
                        </div>
                        <div class="sidebar__sizes">
                            <div class="section-title">
                                <h4>Пазарувай по размер</h4>
                            </div>
                            <div class="size__list">
                                <label for="XXS">
                                    XXS
                                    <input type="checkbox" id="XXS" class="size-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="XS">
                                    XS
                                    <input type="checkbox" id="XS" class="size-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="S">
                                    S
                                    <input type="checkbox" id="S" class="size-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="M">
                                    M
                                    <input type="checkbox" id="M" class="size-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="L">
                                    L
                                    <input type="checkbox" id="L" class="size-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="XL">
                                    XL
                                    <input type="checkbox" id="XL" class="size-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="XXL">
                                    XXL
                                    <input type="checkbox" id="XXL" class="size-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="XXXL">
                                    XXXL
                                    <input type="checkbox" id="XXXL" class="size-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__color">
                            <div class="section-title">
                                <h4>Пазарувай по цвят</h4>
                            </div>
                            <div class="size__list color__list">
                                <label for="Black">
                                    Black
                                    <input type="checkbox" id="Black" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Eggplant">
                                    Eggplant
                                    <input type="checkbox" id="Eggplant" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Night Blue">
                                    Night Blue
                                    <input type="checkbox" id="Night Blue" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Petrol">
                                    Petrol
                                    <input type="checkbox" id="Petrol" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Turkish Blue">
                                    Turkish Blue
                                    <input type="checkbox" id="Turkish Blue" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Sweet Petrol">
                                    Sweet Petrol
                                    <input type="checkbox" id="Sweet Petrol" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Turquoise">
                                    Turquoise
                                    <input type="checkbox" id="Turquoise" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Sky Blue">
                                    Sky Blue
                                    <input type="checkbox" id="Sky Blue" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Hunter Green">
                                    Hunter Green
                                    <input type="checkbox" id="Hunter Green" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Benetton">
                                    Benetton
                                    <input type="checkbox" id="Benetton" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Pistachio">
                                    Pistachio
                                    <input type="checkbox" id="Pistachio" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Mustard">
                                    Mustard
                                    <input type="checkbox" id="Mustard" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Neon Green">
                                    Neon Green
                                    <input type="checkbox" id="Neon Green" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Peach">
                                    Peach
                                    <input type="checkbox" id="Peach" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="White">
                                    White
                                    <input type="checkbox" id="White" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Bordeaux">
                                    Bordeaux
                                    <input type="checkbox" id="Bordeaux" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Red">
                                    Red
                                    <input type="checkbox" id="Red" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="Fuchsia">
                                    Fuchsia
                                    <input type="checkbox" id="Fuchsia" class="color-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        @foreach($products as $value)
                        <div class="col-lg-4 col-md-6">
                            <div class="product__item" data-size="{{ json_encode($value->size) }}" data-color="{{ json_encode($value->color) }}">
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
                            <div class="col-lg-12 text-center">
                                <div class="pagination__option">
                                    @if ($products->currentPage() > 1)
                                        <a href="{{ $products->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a>
                                    @endif

                                    @for ($page = 1; $page <= $products->lastPage(); $page++)
                                        <a href="{{ $products->url($page) }}"{{ $page == $products->currentPage() ? ' class=active' : '' }}>{{ $page }}</a>
                                    @endfor

                                    @if ($products->currentPage() < $products->lastPage())
                                        <a href="{{ $products->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a>
                                    @endif
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

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
                    minamount.val(ui.values[0] + 'лв');
                    maxamount.val(ui.values[1] + 'лв');
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
