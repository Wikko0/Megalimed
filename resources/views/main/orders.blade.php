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
                                        <div class="product__item" data-size="{{ json_encode($value->size) }}" data-color="{{ json_encode($value->color) }}">
                                            <div class="product__item__pic set-bg" data-setbg="{{ProductHelper::getFirstProductImage($value->id)}}">
                                                {!! ProductHelper::getProductLabel($value->id) !!}
                                                <ul class="product__hover">
                                                    <li><a href="{{ProductHelper::getFirstProductImage($value->id)}}" class="image-popup"><span class="arrow_expand"></span></a></li>
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
                    <div class="tab-pane" id="favorites">
                        <h2>Любими</h2>
                        <!-- Включете списък с любимите продукти на потребителя -->
                    </div>
                    <div class="tab-pane" id="orders">
                        <h2>Твоите поръчки</h2>
                        <!-- Включете списък с поръчките на потребителя и тяхното състояние -->
                    </div>
                </div>
            </div>

@endsection
