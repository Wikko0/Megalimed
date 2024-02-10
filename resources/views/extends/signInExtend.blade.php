<div class="account-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="account-close-switch">+</div>
        <form class="account-model-form" method="POST" action="{{ route('login') }}">
            @csrf
            <section class="ftco-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12">
                            <div class="wrap">
                                <div class="login-wrap p-4 p-md-5">
                                    <div class="d-flex">
                                        <div class="w-100">
                                            <h3 class="mb-4">Вход</h3>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="text" name="email" class="form-control" required>
                                        <label class="form-control-placeholder" for="email">Твоят имейл адрес</label>
                                    </div>
                                    <div class="form-group">
                                        <input id="password-field" type="password" name="password" class="form-control" required>
                                        <label class="form-control-placeholder" for="password">Парола</label>
                                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                    <div class="form-group d-md-flex">
                                        <div class="w-50 text-left">
                                            <label class="checkbox-wrap checkbox-primary mb-0">Запомни ме
                                                <input type="checkbox" name="remember" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="w-50 text-md-right">
                                            <a href="#">Забравена парола</a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Вход</button>
                                    </div>
                                    <p class="text-center account-register-switch">Нямаш регистрация? <a data-toggle="tab" href="{{ route('register') }}">Регистрирай се сега</a></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
         </div>
</div>
