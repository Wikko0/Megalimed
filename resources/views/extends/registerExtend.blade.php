<div class="register-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="register-close-switch">+</div>
        <form class="register-model-form" method="POST" action="{{ route('register') }}">
            @csrf
            <section class="ftco-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12">
                            <div class="wrap">
                                <div class="login-wrap p-4 p-md-5">
                                    <div class="d-flex">
                                        <div class="w-100">
                                            <h3 class="mb-4">Регистриране</h3>
                                        </div>
                                    </div>
                                    <form action="#" class="signin-form">
                                        <div class="form-group mt-3">
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                            <label class="form-control-placeholder" for="first_name">Име</label>
                                        </div>
                                        <div class="form-group mt-3">
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                            <label class="form-control-placeholder" for="last_name">Фамилия</label>
                                        </div>
                                        <div class="form-group mt-3">
                                            <input type="text" class="form-control" id="emails" name="email" value="{{ old('email') }}" required>
                                            <label class="form-control-placeholder" for="emails">Твоят имейл адрес</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" name="password" required>
                                            <label class="form-control-placeholder" faor="password">Парола</label>
                                               </div>
                                        <div class="form-group">
                                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Регистрирай се сега</button>
                                        </div>
                                    </form>
                                    <p class="text-center register-account-switch">Вече си член? <a data-toggle="tab" href="{{ route('login') }}">Вход</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
</div>
