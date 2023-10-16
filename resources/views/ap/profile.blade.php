@extends('layouts.admin')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="row g-0">
                <div class="col d-flex flex-column">
                    <div class="card-body">
                        <h2 class="mb-4">My Account</h2>
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <h5><i class="icon fas fa-check"></i> Успешно!</h5>
                                <ul>{{session('success')}}</ul>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-warning alert-dismissible">

                                <h5><i class="icon fas fa-exclamation-triangle"></i> Грешка!</h5>
                                @foreach ($errors->all() as $error)
                                    <ul>{{ $error }}</ul>
                                @endforeach
                            </div>
                        @endif
                        <h3 class="card-title">Profile Details</h3>
                        <div class="row align-items-center">
                            <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url({{asset('admin/img/avatars/avatar.jpg')}})"></span>
                            </div>
                        </div>
                        <form action="{{ route('admin.profile.email') }}" method="post">
                            @csrf
                            <h3 class="card-title mt-4">Email</h3>
                            <div>
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="email" name="new_email" class="form-control w-auto" value="{{ Auth::user()->email }}">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn">
                                            Change
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form action="{{ route('admin.profile.password') }}" method="post">
                            @csrf
                            <h3 class="card-title mt-4">Password</h3>
                            <p class="card-subtitle">You can set a permanent password if you don't want to use temporary login codes.</p>
                            <div class="row g-2">
                                <div class="col-auto">
                                    <input type="password" name="new_password" class="form-control w-auto" placeholder="New Password">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn">
                                        Set new password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
