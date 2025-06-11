@extends('layouts.default')
@section('content')
    <h1 class="visually-hidden">За нас – Качествени медицински униформи и аксесоари от Megalimed</h1>
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
                        <span>За нас</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="blog__details__content">
                        <div class="blog__details__item">
                            <div class="blog__details__item__title">
                                <span class="tip">За нас</span>
                            </div>
                        </div>
                        <div class="blog__details__desc">
                            <p>Здравейте! Ние сме Мегали Медикъл ЕООД, българска фирма основана през 2022 година в община Асеновград. Предлагаме разнообразни модели медицинско облекло и аксесоари от най-високо качество. </p>
                            <p>Много бързо, още в самото начало се утвърдихме на Асеновградския и Пловдивския пазара, като спечелихме клиентите си с безупречни кройки, предоставящи максимално удобство и платове, притежаващи еластичност и лекота.</p>
                        </div>
                        <div class="blog__details__quote">
                            <div class="icon"><i class="fa fa-quote-left"></i></div>
                            <p>През 2022 станахме и официален партньор на Студентски Съвет към  Медицински университет град Пловдив. Освен това чрез онлайн платформите Instagram и Facebook и чрез физически продажби навлязохме на пазара сред студенти, лекари, стоматолози, медицински и балнео-рехабилитационни центрове, болници, лаборатории, кетъринг фирми и много други в област Пловдив и цяла България.</p>
                        </div>
                        <div class="blog__details__desc">
                            <p>Следващият ни успех бе през 2023 година, когато освен със Студентски Съвет към МУ Пловдив, с който продължихме да работим, станахме официален спонсор на 42. Национална Среща на АСМБ и така придобихме популярност сред всички студенти по медицина в България.</p>
                            <p>Включвали сме се и не веднъж към благотворителни кампании и дарения.</p>
                            <p>Нашите медицински екипи, бели престилки, хирургични бонета и другите ни артикули са от висококачествени турски платове със състав, доказан лабораторно.
                                Ние винаги се стремим да подобряваме обслужването си и да обновяваме асортимента си, за да може Вие, клиентите на MegaliMed да сте доволни и щастливи!
                            </p>
                        </div>
                        <div class="blog__details__quote">
                            <p>Мегали Медикъл ЕООД - MAXIMUM QUALITY, MAXIMUM COMFORT !</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Services Section Begin -->
    @include('extends.servicesSection')
    <!-- Services Section End -->

@endsection
