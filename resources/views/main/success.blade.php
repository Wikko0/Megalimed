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
                        <span>Кошница</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Success Order Begin -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card success-order p-4">
                    <h2 class="card-title text-center">Благодарим Ви за поръчката!</h2>
                    <p class="card-text text-center">Вашата поръчка е успешно направена. Ще направим всичко възможно, за да я доставим до вас възможно най-скоро!</p>

                    <ul class="list-unstyled text-center">
                        <li><strong>Име:</strong> {{ $order->first_name }}</li>
                        <li><strong>Фамилия:</strong> {{ $order->last_name }}</li>
                        <li><strong>Държава:</strong> {{ $order->country }}</li>
                        <li><strong>Адрес:</strong> {{ $order->address }}</li>
                        <li><strong>Град:</strong> {{ $order->city }}</li>
                        <li><strong>Пощенски код:</strong> {{ $order->post_code }}</li>
                        <li><strong>Телефонен номер:</strong> {{ $order->number }}</li>
                        <li><strong>Имейл:</strong> {{ $order->email }}</li>
                        <li><strong>Допълнителна информация:</strong> {{ $order->note ?? 'Няма' }}</li>
                    </ul>

                    <p class="card-text text-center">Благодарим ви, че пазарувахте от нас! 🎉</p>
                    <p class="card-text text-center">Очаквайте поръчката си с нетърпение! 🚚</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Success Order End -->

    <!-- Services Section Begin -->
    @include('extends.servicesSection')
    <!-- Services Section End -->

@endsection
