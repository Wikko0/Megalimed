@extends('layouts.account')
@section('form')

            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                        <h2>Профил и сигурност</h2>

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

                    </div>
                    <div class="tab-pane" id="orders">
                        <h2>Твоите поръчки</h2>
                        
                    </div>
                </div>
            </div>

@endsection
