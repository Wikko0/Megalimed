@extends('layouts.account')
@section('form')

    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane active" id="profile">
                <h2 class="m-2">Твоите поръчки</h2>
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        @foreach($products as $value)
                            <div class="col-lg-4 col-md-6">
                                <article class="product__item" data-size="{{ json_encode($value->size) }}" data-color="{{ json_encode($value->color) }}" aria-label="Продукт {{$value->name}}, размери и цветове">
                                    <div class="product__item__pic">

                                        <a href="/product/{{$value->slug}}" title="Виж детайли за продукта {{$value->name}}">
                                            <img
                                                src="{{ ProductHelper::getFirstProductImage($value->id) }}"
                                                alt="Изображение на продукт {{$value->name}}"
                                                loading="lazy"
                                                width="300"
                                                height="300"
                                            >
                                        </a>
                                        {!! ProductHelper::getProductLabel($value->id) !!}
                                        <ul class="product__hover">
                                            <li>
                                                <a href="{{ProductHelper::getFirstProductImage($value->id)}}"
                                                   class="image-popup"
                                                   aria-label="Увеличи изображение на продукт {{$value->name}}">
                                                    <span class="arrow_expand"></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/product/{{$value->slug}}" aria-label="Виж продукта {{$value->name}}">
                                                    <span class="icon_bag_alt"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h3><a href="/product/{{$value->slug}}" title="Виж продукта {{$value->name}}">{{$value->name}}</a></h3>
                                        <div class="rating" role="img" aria-label="Рейтинг: 5 от 5 звезди">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        {!! ProductHelper::getPriceHtml($value->id) !!}
                                    </div>
                                </article>
                            </div>
                        @endforeach
                        <div class="col-lg-12 text-center">
                            <nav class="pagination__option" role="navigation" aria-label="Навигация за страници">
                                @if ($products->currentPage() > 1)
                                    <a href="{{ $products->previousPageUrl() }}" aria-label="Предишна страница"><i class="fa fa-angle-left"></i></a>
                                @endif

                                @for ($page = 1; $page <= $products->lastPage(); $page++)
                                    <a href="{{ $products->url($page) }}"{{ $page == $products->currentPage() ? ' class=active aria-current=page' : '' }} aria-label="Страница {{ $page }}">{{ $page }}</a>
                                @endfor

                                @if ($products->currentPage() < $products->lastPage())
                                    <a href="{{ $products->nextPageUrl() }}" aria-label="Следваща страница"><i class="fa fa-angle-right"></i></a>
                                @endif
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="favorites">
                <h2>Любими</h2>

            </div>
            <div class="tab-pane" id="orders">
                <h2>Твоите поръчки</h2>

            </div>
        </div>
    </div>

@endsection
