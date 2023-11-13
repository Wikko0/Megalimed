<div class="calculator-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="calculator-close-switch">+</div>
        <form class="calculator-model-form" method="POST" action="{{ route('calculator') }}">
            @csrf
            <section class="ftco-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12">
                            <div class="wrap">
                                <div class="login-wrap p-4 p-md-5">
                                    <div class="d-flex">
                                        <div class="w-100">
                                            <h3 class="mb-4">Калкулатор</h3>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="number" name="height" class="form-control" required min="150" max="190">
                                        <label class="form-control-placeholder" for="height">Въведи вашите сантиментри</label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="number" name="kilograms" class="form-control" required min="50" max="120">
                                        <label class="form-control-placeholder" for="kilograms">Въведи вашите килограми</label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Изчисли</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
         </div>
</div>
