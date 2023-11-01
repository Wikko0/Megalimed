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
                                    <li>
                                        <a wire:click="addToCart({{ $value->id }})" wire:model="showCartPopup">
                                            <span class="icon_bag_alt"></span>
                                        </a>
                                    </li>
                                @else
                                    <li><a href="#"><span class="icon_heart_alt account-switch"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                @endif

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


