@extends('layouts.admin')
@section('content')

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Sales</div>
                                <div class="ms-auto lh-1">

                                </div>
                            </div>
                            <div class="h1 mb-3">{{$count}}</div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: {{$count}}%" role="progressbar" aria-valuenow="{{$count}}" aria-valuemin="0" aria-valuemax="500" aria-label="{{$count}}% Complete">
                                    <span class="visually-hidden">{{$count}}% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Revenue</div>
                                <div class="ms-auto lh-1">
                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">
                                    {{ $totalPrice }} лв.
                                    <span class="text-muted" style="font-size: 0.8em;">
                                        ({{ number_format($totalPrice / 1.9558, 2) }} €)
                                    </span>
                                </div>
                                <div class="me-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">New clients</div>
                                <div class="ms-auto lh-1">
                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-3 me-2">{{$newUsersCount}}</div>
                                <div class="me-auto">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total users</div>
                                <div class="ms-auto lh-1">
                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-3 me-2">{{$totalUsersCount}}</div>
                                <div class="me-auto">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
