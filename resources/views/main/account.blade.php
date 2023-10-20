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
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Account</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Account -->
    <section class="account">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                <div class="list-group">
                    <a href="#profile" class="list-group-item list-group-item-action active">Профил и сигурност</a>
                    <a href="#favorites" class="list-group-item list-group-item-action">Любими</a>
                    <a href="#orders" class="list-group-item list-group-item-action">Твоите поръчки</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                        <h2>Профил и сигурност</h2>
                        <!-- Включете форма за редактиране на информацията за профила, например име, фамилия, имейл и др. -->
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="first_name">Име:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ explode(' ', auth()->user()->name)[0]}}">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Фамилия:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ explode(' ', auth()->user()->name)[1]}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Имейл:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Парола:</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Запази промените</button>
                        </form>
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
        </div>
    </div>
    </section>
    <!-- Account End -->


    <!-- Services Section Begin -->
    @include('extends.servicesSection')
    <!-- Services Section End -->
@endsection
