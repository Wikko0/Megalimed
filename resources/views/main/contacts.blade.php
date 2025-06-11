@extends('layouts.default')
@section('content')
    <h1 class="visually-hidden">Свържете се с нас – Megalimed</h1>
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
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Начало</a>
                        <span>Контакти</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__content">
                        <div class="contact__address">
                            <h5>Свържи се с нас</h5>
                            <ul>
                                <li>
                                    <h6><i class="fa fa-map-marker"></i> Адрес</h6>
                                    <p>{{$settingsProvider->address}}</p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-phone"></i> Телефонен номер</h6>
                                    <p><span>{{$settingsProvider->phone}}</span></p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-headphones"></i> Емайл адрес</h6>
                                    <p>{{$settingsProvider->email}}</p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-facebook"></i> Фейсбук</h6>
                                    <p><a href="{{$settingsProvider->facebook}}">{{$settingsProvider->facebook}}</a></p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-instagram"></i> Инстаграм</h6>
                                    <p><a href="{{$settingsProvider->instagram}}">{{$settingsProvider->instagram}}</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2958.7255326764243!2d24.715965800000003!3d42.1347587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14acd029e88b03cf%3A0x76eb5618ebf7e379!2z0YPQuy4g4oCe0KbQsNGA0LXQstC10YbigJwgMiwgNDAwMSDQti7Qui4g0KXRgNC40YHRgtC-INCh0LzQuNGA0L3QtdC90YHQutC4LCDQn9C70L7QstC00LjQsg!5e0!3m2!1sbg!2sbg!4v1699343015932!5m2!1sbg!2sbg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Services Section Begin -->
    @include('extends.servicesSection')
    <!-- Services Section End -->

@endsection
