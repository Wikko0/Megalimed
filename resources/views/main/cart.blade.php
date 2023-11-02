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
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <!-- Shop Cart Section Begin -->

    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>

                            @livewire('cart-table')

                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="#">Continue Shopping</a>
                    </div>
                </div>
                @livewire('cart-total')
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->
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
