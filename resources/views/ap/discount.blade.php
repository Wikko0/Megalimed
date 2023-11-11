@extends('layouts.admin')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="row g-0">
                <div class="col d-flex flex-column">
                    <div class="card-body">
                        <h2 class="mb-4">Discount Settings</h2>
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
                        <form action="{{ route('admin.discount.form') }}" method="post">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Create Discount</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-6 col-2">
                                    <label class="row">
                                        <span class="form-label col required">Status</span>
                                        <span class="col-auto">
                                    <label class="form-check form-check-single form-switch">
                                      <input class="form-check-input" type="checkbox" name="status" @if(!empty($discount->status)) checked @endif >
                                    </label>
                                  </span>
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Discount name</label>
                                    <div>
                                        <input type="text" class="form-control" placeholder="Discount name" name="name" value="{{$discount->name??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Percent</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Percent of discount" name="percent" value="{{$discount->percent??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Date &amp; Hour of end (Day, Month, Year) </label>
                                    <input type="text" name="date" class="form-control" data-mask="00/00/0000 00:00:00" data-mask-visible="true" placeholder="00/00/0000 00:00:00" value="{{$discount->date??null}}" autocomplete="off"/>
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
