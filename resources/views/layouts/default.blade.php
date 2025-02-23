<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Онлайн магазин за медицински дрехи - предлагаме голямо разнообразие от професионални и стилни дрехи за медицински персонал.">
    <meta name="keywords" content="megalimed, мегалимед, медицински дрехи, лекарски халати, медицински униформи, медицински облекла, медицинско облекло">
    <meta property="og:title" content="Мегалимед">
    <meta property="og:url" content="http://megalimed.com"/>
    <meta property="og:description"
          content="Онлайн магазин за медицински дрехи - предлагаме голямо разнообразие от професионални и стилни дрехи за медицински персонал."/>
    <meta property="og:site_name" content="Мегалимед"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>Megalimed | Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comforter&family=Comforter+Brush&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('favicon.png')}}" />

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('css/login.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
    @livewireStyles

</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__close">+</div>
    <ul class="offcanvas__widget">
        @if(Auth::user())
            <li style="display: block; text-align: center;">
            <span class="icon_profile"></span>
                <a class="ml-2" href="{{ route('account') }}">{{ Auth::user()->name }}</a>
            </li>
            <li><a href="{{route('favorites')}}"><span class="icon_heart_alt"></span><div class="tip">{{ProductHelper::countFavorites(Auth::user()->id)}}</div></a></li>
        @else
            <li><span class="icon_profile account-switch"></span></li>
            <li><a href="#"><span class="icon_heart_alt account-switch"></span><div class="tip">0</div></a></li>
        @endif

         @livewire('cart-counter')

    </ul>
    <div class="offcanvas__logo">
        <a href="/"><img src="{{asset('img/logo.png')}}" alt=""></a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__auth">
        @if(Auth::user())
            <span class="icon_profile"></span><a href="{{route('account')}}">{{Auth::user()->name}}</a>
            <a class="ml-2" href="{{route('logout')}}">Изход</a>
        @else
        <a class="account-switch" href="#">Вход</a>
        <a class="register-switch" href="#">Регистрация</a>
        @endif
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-5 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="/">Начало</a></li>
                        @foreach($categoryProvider as $values)
                        <li><a href="/shop/{{$values->url}}">{{$values->menu}}</a></li>
                        @endforeach
                        <li><a href="{{route('shop')}}">Магазин</a></li>
                        <li><a href="{{route('about')}}">За нас</a></li>
                        <li><a href="{{route('contact')}}">Контакти</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-xl-4 col-lg-2">
                <div class="header__logo">
                    <a href="/"><img src="{{asset('img/logo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <ul class="header__right__widget">
                        @if(Auth::user())
                            <li><span class="icon_profile"></span><a class="ml-2" href="{{route('account')}}">{{Auth::user()->name}}</a></li>
                            <li><a href="{{route('favorites')}}"><span class="icon_heart_alt"></span>
                                    <div class="tip">{{ProductHelper::countFavorites( Auth::user()->id )}}</div>
                                </a></li>
                        @else
                            <li><span class="icon_profile account-switch"></span></li>
                            <li><a href="#"><span class="icon_heart_alt account-switch"></span>
                                    <div class="tip">0</div>
                                </a></li>
                        @endif

                            @livewire('cart-counter')

                    </ul>
                </div>
            </div>

        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>

    </div>
</header>
<!-- Header Section End -->

<!-- Content -->
@yield('content')
<!-- Content End -->


<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="/"><img src="{{asset('img/logo.png')}}" alt=""></a>
                    </div>
                    <p>Вашият онлайн магазин за медицински дрехи.</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <h6>Бързи линкове</h6>
                    <ul>
                        <li><a href="{{route('about')}}">За нас</a></li>
                        <li><a href="{{route('contact')}}">Контакти</a></li>
                        <li><a href="{{$settingsProvider->instagram ?? 'https://www.instagram.com/'}}">Instagram</a></li>
                        <li><a href="{{$settingsProvider->facebook ?? 'https://www.facebook.com/'}}">Facebook</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>Акаунт</h6>
                    <ul>
                        <li><a href="{{route('account')}}">Моят акаунт</a></li>
                        <li><a href="{{route('favorites')}}">Любими</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>Абонирай се</h6>
                    <form action="#">
                        <input type="text" placeholder="Емайл">
                        <button type="submit" class="site-btn">Абонирай се</button>
                    </form>
                    <div class="footer__social">
                        <a href="{{$settingsProvider->facebook}}"><i class="fa fa-facebook"></i></a>
                        <a href="{{$settingsProvider->instagram}}"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright__text">
                    <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> Megalimed. Всички права запазени!</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Cart message -->
<div class="cart-popup" id="cartPopup" wire:loading.remove>
    <div class="cart-popup-content">
        <span class="close-popup" id="closePopup" >&times;</span>
        <h3>Успешно добавихте продукта в кошницата</h3>
        <div class="buttons">
            <button id="continueShopping" class="continue-shopping-button">Продължи да пазаруваш</button>
            <button id="viewCart" class="view-cart-button">Към кошницата</button>
        </div>
    </div>
</div>
<!-- Cart message End -->

<!-- SingIn Begin -->
@include('extends.signInExtend')
<!-- SingIn End -->


<!-- Register Begin -->
@include('extends.registerExtend')
<!-- Register End -->

<!-- Js Plugins -->
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/mixitup.min.js')}}"></script>
<script src="{{asset('js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('js/jquery.slicknav.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="https://unpkg.com/@panzoom/panzoom@4.6.0/dist/panzoom.min.js"></script>
@livewireScripts
@yield('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('cart_updated', () => {
            // Показване на прозореца
            document.getElementById("cartPopup").style.display = "block";
        });

        // Затваряне на прозореца
        document.getElementById("closePopup").addEventListener("click", function() {
            document.getElementById("cartPopup").style.display = "none";
        });

        // Продължаване на пазаруването
        document.getElementById("continueShopping").addEventListener("click", function() {
            document.getElementById("cartPopup").style.display = "none";
        });

        // Отиване към кошницата
        document.getElementById("viewCart").addEventListener("click", function() {
            // Пренасочване към страницата на кошницата
            window.location.href = "/cart"; // Заменете с правилния URL
        });
    });
</script>

</body>

</html>
