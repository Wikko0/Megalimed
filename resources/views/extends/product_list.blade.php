@foreach($products as $value)
    <div class="col-lg-3 col-md-4 col-sm-6 mix {{$value->category->url}}">
        <div class="product__item">
            <div class="product__item__pic set-bg product-image" data-setbg="{{ProductHelper::getFirstProductImage($value->id)}}" data-product-url="/product/{{$value->id}}" data-product-image="{{ProductHelper::getSecondProductImage($value->id)}}">
                {!! ProductHelper::getProductLabel($value->id) !!}
                <ul class="product__hover">
                    <li><a href="{{ProductHelper::getFirstProductImage($value->id)}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                    @if(Auth::user())
                        <li><a href="{{route('make.favorites', [$value->id])}}"><span class="icon_heart_alt"></span></a></li>
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
