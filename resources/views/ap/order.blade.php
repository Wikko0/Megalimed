@extends('layouts.admin')

@section('content')
    <div class="page-body">
        <!-- Success/ Errors -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <h5><i class="icon fas fa-check"></i> Успешно!</h5>
                <ul>{{ session('success') }}</ul>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-warning alert-dismissible">
                <h5><i class="icon fas fa-exclamation-triangle"></i> Грешка!</h5>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif
    <!-- Success/ Errors End -->

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Orders List</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                        <tr>
                            <th class="w-1">Id.</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Address or office code</th>
                            <th>City</th>
                            <th>Post Code</th>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td><span class="text-muted">{{ $loop->iteration + ($orders->perPage() * ($orders->currentPage() - 1)) }}</span></td>
                                <td>{{ $order->first_name }}</td>
                                <td>{{ $order->country }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->city }}</td>
                                <td>{{ $order->post_code }}</td>
                                <td>{{ $order->number }}</td>
                                <td>{{ $order->email }}</td>
                                <td>
                                    @if($order->products)
                                        @foreach(json_decode($order->products, true) as $product)
                                            Продукта: {{ $product['product'] }},<br>
                                            Количество: {{ $product['quantity'] }},<br>
                                            Цена: {{ $product['price'] }},<br>
                                            Размер: {{ $product['size'] }},<br>
                                            Цвят: {{ $product['color'] }}<br><br>
                                        @endforeach
                                    @else
                                        Няма налични продукти.
                                    @endif
                                </td>
                                @if($order->status == 'Awaiting approval')
                                <td style="color: red">{{  $order->status }}</td>
                                @else
                                    <td style="color: green">{{  $order->status }}</td>
                                @endif
                                <td class="text-end">
                                <span class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                         <form method="post" action="{{ route('admin.order.form', ['id' => $order->id]) }}">
                                            @csrf
                                             @if($order->status == 'Awaiting approval')
                                            <button class="dropdown-item">
                                                Sent
                                            </button>
                                             @else
                                            <button class="dropdown-item">
                                                Awaiting approval
                                            </button>
                                             @endif
                                        </form>
                                    </div>

                                </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} entries</p>
                    <ul class="pagination m-0 ms-auto">
                        @if ($orders->onFirstPage())
                            <li class="page-item disabled">
                <span class="page-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                    prev
                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $orders->previousPageUrl() }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                                    prev
                                </a>
                            </li>
                        @endif

                        @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                            @if ($page == $orders->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if ($orders->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $orders->nextPageUrl() }}">
                                    next
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                <span class="page-link">
                    next
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                </span>
                            </li>
                        @endif
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
