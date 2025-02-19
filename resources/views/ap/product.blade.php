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
                    <h3 class="card-title">Product List</h3>
                </div>
                <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                        <div class="ms-auto text-muted">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-product">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                Create new product
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                        <tr>
                            <th class="w-1">Id.</th>
                            <th>Name of product</th>
                            <th>Barcode</th>
                            <th>Description</th>
                            <th>Specification</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><span class="text-muted">{{ $loop->iteration + ($products->perPage() * ($products->currentPage() - 1)) }}</span></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->barcode }}</td>
                                <td>
                                   <textarea rows="5" class="form-control" placeholder="Here can be your description">{{ $product->description }}</textarea>
                                </td>
                                <td>
                                    <textarea rows="5" class="form-control" placeholder="Here can be your description">{{ $product->specification }}</textarea>
                                </td>
                                <td>{{ $product->price }} lv.</td>
                                @if($product->discount)
                                <td>{{ $product->discount }} lv.</td>
                                @else
                                    <td>No</td>
                                @endif
                                <td>{{ implode(', ', json_decode($product->color)) }}</td>
                                <td>{{ implode(', ', json_decode($product->size)) }}</td>
                                @if($product->status == 'Published')
                                <td style="color: green">{{  $product->status }}</td>
                                @else
                                    <td style="color: red">{{  $product->status }}</td>
                                @endif
                                <td class="text-end">
                                <span class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('admin.product.edit', ['id' => $product->id]) }}">
                                            Edit
                                        </a>
                                        <form method="post" action="{{ route('admin.product.delete', ['id' => $product->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item">
                                                Delete
                                            </button>
                                        </form>
                                         <form method="post" action="{{ route('admin.product.status', ['id' => $product->id]) }}">
                                            @csrf
                                             @if($product->status == 'Published')
                                            <button class="dropdown-item">
                                                Inactive
                                            </button>
                                             @else
                                            <button class="dropdown-item">
                                                Active
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
                    <p class="m-0 text-muted">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries</p>
                    <ul class="pagination m-0 ms-auto">
                        @if ($products->onFirstPage())
                            <li class="page-item disabled">
                <span class="page-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                    prev
                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $products->previousPageUrl() }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                                    prev
                                </a>
                            </li>
                        @endif

                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if ($page == $products->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if ($products->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $products->nextPageUrl() }}">
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
