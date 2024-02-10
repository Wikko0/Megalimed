@extends('layouts.admin')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="row g-0">
                <div class="col d-flex flex-column">
                    <div class="card-body">
                        <h2 class="mb-4">Web Settings</h2>
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
                        <form action="{{ route('admin.settings.form') }}" method="post">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Contact Settings</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Email address</label>
                                    <div>
                                        <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{$settings->email??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Address</label>
                                    <div>
                                        <input type="text" class="form-control" placeholder="Address" name="address" value="{{$settings->address??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Phone</label>
                                    <div>
                                        <input type="text" class="form-control" placeholder="Phone Number" name="phone" value="{{$settings->phone??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Facebook</label>
                                    <div>
                                        <input type="url" class="form-control" placeholder="Enter Facebook page" name="facebook" value="{{$settings->facebook??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Instagram</label>
                                    <div>
                                        <input type="url" class="form-control" placeholder="Enter Instagram" name="instagram" value="{{$settings->instagram??null}}">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
