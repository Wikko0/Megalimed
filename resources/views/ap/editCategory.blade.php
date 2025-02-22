@extends('layouts.admin')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row g-0">
                    <div class="col d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">Edit Category - {{$category->name}}</h2>
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
                            <form action="{{ route('admin.category.edit', $category->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h3 class="card-title">Category - {{$category->name}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Number</label>
                                        <input type="number" class="form-control" name="number" placeholder="Number of the location to be displayed" value="{{ old('name', $category->number) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter menu category name" value="{{ old('name', $category->name) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="menu" placeholder="Enter menu category name" value="{{ old('menu', $category->menu) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control"
                                                  rows="5"
                                                  name="description" >{{ old('description', $category->description) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Url</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ url('/shop') }}/</span>
                                            <input type="text" class="form-control" name="url" placeholder="Enter URL" value="{{ old('url', $category->url) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-label">Image</div>
                                    <input type="file" name="image" class="form-control" id="imageInput" accept="image/*" />
                                </div>

                                @if($category->image)
                                    <div class="mb-3">
                                        <label class="form-label">Current Image</label>
                                        <div>
                                            <img id="previewImage" src="{{ asset($category->image) }}" alt="Category Image" class="img-fluid" style="max-width: 200px;">
                                        </div>
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-primary ms-auto" data-dismiss="modal">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Edit category
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>


    </script>
@endsection
