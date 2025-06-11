<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta name="author" content="Megalimed">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>Медицински екипи и униформи | Онлайн магазин Megalimed</title>
    <meta name="description" content="Купи онлайн медицински екипи, униформи и медицински дрехи за лекари, медицински сестри и персонал. Високо качество, модерен дизайн и бърза доставка.">
    <meta name="keywords" content="медицински екипи, медицински дрехи, медицински униформи, лекарски халати, дамски медицински дрехи, мъжки медицински екипи, облекло за медицински персонал, Megalimed, Мегалимед">

    <!-- Canonical и Sitemap -->
    <link rel="canonical" href="https://megalimed.com/">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="/public/sitemap.xml">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Медицински екипи и дрехи от Megalimed">
    <meta property="og:description" content="Онлайн магазин за модерни и качествени медицински екипи, дрехи и униформи. Дамски и мъжки модели за медицински персонал.">
    <meta property="og:url" content="https://megalimed.com/">
    <meta property="og:site_name" content="Megalimed">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://megalimed.com/img/logo.svg">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Медицински екипи и дрехи | Megalimed">
    <meta name="twitter:description" content="Професионални медицински дрехи, екипи и униформи с високо качество и бърза доставка.">
    <meta name="twitter:image" content="https://megalimed.com/img/logo.svg">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comforter&family=Comforter+Brush&display=swap" rel="stylesheet">

    <!-- Preload CSS/JS/IMAGES -->
    <link rel="preload" href="{{ asset('css/style.css') }}" as="style">
    <link rel="preload" href="{{ asset('js/main.js') }}" as="script">
    <link rel="preload" as="image" href="{{ asset($categoryProvider[0]->image) }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    @livewireStyles

    <!-- Structured Data -->
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Store",
          "name": "Megalimed",
          "url": "https://megalimed.com/",
          "logo": "https://megalimed.com/img/logo.svg",
          "image": "https://megalimed.com/img/logo.svg",
          "sameAs": [
            "{{ $settingsProvider->facebook ?? 'https://www.facebook.com/' }}",
        "{{ $settingsProvider->instagram ?? 'https://www.instagram.com/' }}"
      ],
      "address": {
        "@type": "PostalAddress",
        "addressCountry": "BG"
      }
    }
    </script>
    @yield('jsonld')

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BQ65YJ45N6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-BQ65YJ45N6');
    </script>
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
        <a href="{{route('home')}}"><img src="{{asset('img/logo.svg')}}" alt="Megalimed - Онлайн магазин за медицински дрехи" width="204" height="38"></a>
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
                        <li class="active"><a href="{{route('home')}}">Начало</a></li>
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
                    <a href="{{route('home')}}"><img src="{{asset('img/logo.svg')}}" alt="Megalimed - Начало" width="204" height="38"></a>
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
                        <a href="{{route('home')}}"><img src="{{asset('img/logo.svg')}}" alt="Megalimed - Медицински екипи и униформи" width="204" height="38"></a>
                    </div>
                    <p>Вашият онлайн магазин за медицински дрехи.</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <h6>Бързи линкове</h6>
                    <ul>
                        <li><a href="{{route('about')}}" aria-label="За нас">За нас</a></li>
                        <li><a href="{{route('contact')}}" aria-label="Контакти с нас">Контакти</a></li>
                        <li><a href="{{$settingsProvider->instagram ?? 'https://www.instagram.com/'}}" aria-label="Посети нашата Инстаграм страница">Instagram</a></li>
                        <li><a href="{{$settingsProvider->facebook ?? 'https://www.facebook.com/'}}" aria-label="Посети нашата Facebook страница">Facebook</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>Акаунт</h6>
                    <ul>
                        <li><a href="{{route('account')}}" aria-label="Посети вашият акаунт">Моят акаунт</a></li>
                        <li><a href="{{route('favorites')}}" aria-label="Любими">Любими</a></li>
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
                        <a href="{{$settingsProvider->facebook}}" aria-label="Посети нашата Facebook страница"><i class="fa fa-facebook"></i></a>
                        <a href="{{$settingsProvider->instagram}}" aria-label="Посети нашата Инстаграм страница"><i class="fa fa-instagram"></i></a>
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

            document.getElementById("cartPopup").style.display = "block";
        });

        document.getElementById("closePopup").addEventListener("click", function() {
            document.getElementById("cartPopup").style.display = "none";
        });

        document.getElementById("continueShopping").addEventListener("click", function() {
            document.getElementById("cartPopup").style.display = "none";
        });


        document.getElementById("viewCart").addEventListener("click", function() {

            window.location.href = "/cart";
        });
    });
</script>
<script src="https://integrateai.website/static/js/integration/embed-chatbot.js?bot_id=1d229d13-cbce-4eb4-a284-b9fd7d4c05b2&token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjaGF0Ym90X2lkIjoiMWQyMjlkMTMtY2JjZS00ZWI0LWEyODQtYjlmZDdkNGMwNWIyIiwidXNlcl9pZCI6IjEiLCJkb21haW4iOiJtZWdhbGltZWQuY29tIiwiaWF0IjoxNzQzNjg5NDc1Ljg5Mzk2OSwiZXhwIjoxOTIzNjg5NDc1Ljg5Mzk2OSwic3ViIjoiYWRtaW4ifQ.oXszLg-VjlzjCZm7WwqrbZNRhIVBUzT8cN_FxmGCGW0&style=true&btn-bg=%2300ffe3&btn-hov=%2301beab"></script>
<script>

    document.addEventListener("DOMContentLoaded", function () {
        const observer = new MutationObserver(() => {
            const iframe = document.querySelector("iframe.chatbot-iframe");
            if (iframe && !iframe.title) {
                iframe.title = "Чатбот за клиентска поддръжка на Megalimed";
                observer.disconnect();
            }
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    });
</script>
</body>

</html>
