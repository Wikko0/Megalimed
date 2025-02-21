@extends('layouts.admin')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row g-0">
                    <div class="col d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">Edit Product - {{$product->name}}</h2>
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
                            <form action="{{ route('admin.product.edit', $product->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h3 class="card-title">Product - {{$product->name}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Your category name" value="{{ old('name', $product->name) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Barcode</label>
                                        <input type="text" name="barcode" class="form-control" data-mask="00000000" data-mask-visible="true" placeholder="Barcode example: 00000000 "  value="{{ old('barcode', $product->barcode) }}" autocomplete="off"/>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control"
                                                  rows="5"
                                                  name="description" >{{ old('description', $product->description) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Specification</label>
                                        <textarea class="form-control"
                                                  rows="5"
                                                  name="specification">{{ old('specification', $product->specification) }}</textarea>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Pricing</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="number" class="form-control" name="price" placeholder="Price" value="{{ old('price', $product->price) }}">
                                    </div>

                                    <label class="form-label">Discount type</label>
                                    <div class="form-selectgroup-boxes row mb-3">
                                        <div class="col-lg-6">
                                            <label class="form-selectgroup-item">
                                                <input type="radio" name="discount-type" value="none" class="form-selectgroup-input" checked>
                                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                        <span class="me-3">
                                                            <span class="form-selectgroup-check"></span>
                                                        </span>
                                                        <span class="form-selectgroup-label-content">
                                                            <span class="form-selectgroup-title strong mb-1">None</span>
                                                            <span class="d-block text-muted">The product will not be discounted</span>
                                                        </span>
                                                    </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-selectgroup-item">
                                                <input type="radio" name="discount-type" value="discounted" class="form-selectgroup-input">
                                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                        <span class="me-3">
                                                            <span class="form-selectgroup-check"></span>
                                                        </span>
                                                        <span class="form-selectgroup-label-content">
                                                            <span class="form-selectgroup-title strong mb-1">Discounted</span>
                                                            <span class="d-block text-muted">The product will be discounted, and you will be able to enter a price</span>
                                                        </span>
                                                    </span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-3" id="discountedPriceField" style="display: none;">
                                        <label class="form-label">Discounted Price</label>
                                        <input type="number" class="form-control" name="discount" placeholder="Discounted Price" value="{{ old('discount', $product->discount) }}">
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Organize</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select name="category_id" class="form-select">
                                            @foreach($categoryProvider as $values)
                                                <option value="{{$values->id}}" {{ $values->id == old('category_id', $product->category_id) ? 'selected' : '' }}>{{$values->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Variants</h5>

                                    <div class="mb-3">
                                        @foreach($variants as $variant)
                                            <div class="mb-3 size-field">
                                                <label class="form-label">{{ $variant['color'] }} - {{ $variant['size'] }}</label>
                                                <input type="number" name="stock[{{ $variant['color'] }}-{{ $variant['size'] }}]" class="form-control" placeholder="Products in Stock" value="{{ old('stock.' . $variant['color'] . '-' . $variant['size'], $variant['quantity']) }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <label class="form-label">Add new product</label>
                                <div class="form-selectgroup-boxes row mb-3">
                                    <div class="col-lg-6">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="new-product" value="none" class="form-selectgroup-input" checked>
                                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                        <span class="me-3">
                                                            <span class="form-selectgroup-check"></span>
                                                        </span>
                                                        <span class="form-selectgroup-label-content">
                                                            <span class="form-selectgroup-title strong mb-1">None</span>
                                                            <span class="d-block text-muted">I don't want to add new product</span>
                                                        </span>
                                                    </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="new-product" value="add-new-product" class="form-selectgroup-input">
                                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                        <span class="me-3">
                                                            <span class="form-selectgroup-check"></span>
                                                        </span>
                                                        <span class="form-selectgroup-label-content">
                                                            <span class="form-selectgroup-title strong mb-1">Add new product</span>
                                                            <span class="d-block text-muted">I want to add new product</span>
                                                        </span>
                                                    </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="card-body" id="addNewProductField" style="display: none;">
                                    <h5 class="modal-title">Add new product</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Colors</label>
                                        <div class="form-selectgroup">
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Black" class="form-selectgroup-input" data-color="Black">
                                                <span class="form-selectgroup-label">Black</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Eggplant" class="form-selectgroup-input" data-color="Eggplant">
                                                <span class="form-selectgroup-label">Eggplant</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Night Blue" class="form-selectgroup-input" data-color="Night Blue">
                                                <span class="form-selectgroup-label">Night Blue</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Petrol" class="form-selectgroup-input" data-color="Petrol">
                                                <span class="form-selectgroup-label">Petrol</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Turkish Blue" class="form-selectgroup-input" data-color="Turkish Blue">
                                                <span class="form-selectgroup-label">Turkish Blue</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Sweet Petrol" class="form-selectgroup-input" data-color="Sweet Petrol">
                                                <span class="form-selectgroup-label">Sweet Petrol</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Turquoise" class="form-selectgroup-input" data-color="Turquoise">
                                                <span class="form-selectgroup-label">Turquoise</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Sky Blue" class="form-selectgroup-input" data-color="Sky Blue">
                                                <span class="form-selectgroup-label">Sky Blue</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Hunter Green" class="form-selectgroup-input" data-color="Hunter Green">
                                                <span class="form-selectgroup-label">Hunter Green</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Benetton" class="form-selectgroup-input" data-color="Benetton">
                                                <span class="form-selectgroup-label">Benetton</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Pistachio" class="form-selectgroup-input" data-color="Pistachio">
                                                <span class="form-selectgroup-label">Pistachio</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Mustard" class="form-selectgroup-input" data-color="Mustard">
                                                <span class="form-selectgroup-label">Mustard</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Neon Green" class="form-selectgroup-input" data-color="Neon Green">
                                                <span class="form-selectgroup-label">Neon Green</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Peach" class="form-selectgroup-input" data-color="Peach">
                                                <span class="form-selectgroup-label">Peach</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="White" class="form-selectgroup-input" data-color="White">
                                                <span class="form-selectgroup-label">White</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Bordeaux" class="form-selectgroup-input" data-color="Bordeaux">
                                                <span class="form-selectgroup-label">Bordeaux</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Red" class="form-selectgroup-input" data-color="Red">
                                                <span class="form-selectgroup-label">Red</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="color[]" value="Fuchsia" class="form-selectgroup-input" data-color="Fuchsia">
                                                <span class="form-selectgroup-label">Fuchsia</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Size</label>
                                        <div class="form-selectgroup">
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="size[]" value="XXS" class="form-selectgroup-input" data-size="XXS">
                                                <span class="form-selectgroup-label">XXS</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="size[]" value="XS" class="form-selectgroup-input" data-size="XS">
                                                <span class="form-selectgroup-label">XS</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="size[]" value="S" class="form-selectgroup-input" data-size="S">
                                                <span class="form-selectgroup-label">S</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="size[]" value="M" class="form-selectgroup-input" data-size="M">
                                                <span class="form-selectgroup-label">M</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="size[]" value="L" class="form-selectgroup-input" data-size="L">
                                                <span class="form-selectgroup-label">L</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="size[]" value="XL" class="form-selectgroup-input" data-size="XL">
                                                <span class="form-selectgroup-label">XL</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="size[]" value="XXL" class="form-selectgroup-input" data-size="XXL">
                                                <span class="form-selectgroup-label">XXL</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="size[]" value="XXXL" class="form-selectgroup-input" data-size="XXXL">
                                                <span class="form-selectgroup-label">XXXL</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-3" id="stock-fields">

                                    </div>
                                </div>


                                <label class="form-label">Change Media</label>
                                <div class="form-selectgroup-boxes row mb-3">
                                    <div class="col-lg-6">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="change-media" value="none" class="form-selectgroup-input" checked>
                                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                        <span class="me-3">
                                                            <span class="form-selectgroup-check"></span>
                                                        </span>
                                                        <span class="form-selectgroup-label-content">
                                                            <span class="form-selectgroup-title strong mb-1">None</span>
                                                            <span class="d-block text-muted">I don't want to change media</span>
                                                        </span>
                                                    </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="change-media" value="change-media" class="form-selectgroup-input">
                                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                        <span class="me-3">
                                                            <span class="form-selectgroup-check"></span>
                                                        </span>
                                                        <span class="form-selectgroup-label-content">
                                                            <span class="form-selectgroup-title strong mb-1">Change Media</span>
                                                            <span class="d-block text-muted">I want to change medias</span>
                                                        </span>
                                                    </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="card-body" id="changeMediaField" style="display: none;">
                                    <div class="modal-body">
                                        <h5 class="modal-title">Media</h5>
                                        <div class="mb-8">

                                            <input type="file" name="media" id="media" accept="image/jpeg, image/png" multiple />

                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary ms-auto" data-dismiss="modal">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Edit product
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        const colorCheckboxes = document.querySelectorAll('input[name="color[]"]');
        const sizeCheckboxes = document.querySelectorAll('input[name="size[]"]');
        const stockFields = document.getElementById('stock-fields');

        function updateStockFields() {
            stockFields.innerHTML = '';

            colorCheckboxes.forEach(colorCheckbox => {
                if (colorCheckbox.checked) {
                    sizeCheckboxes.forEach(sizeCheckbox => {
                        if (sizeCheckbox.checked) {
                            const color = colorCheckbox.getAttribute('data-color');
                            const size = sizeCheckbox.getAttribute('data-size');

                            const field = document.createElement('div');
                            field.classList.add('mb-3', 'size-field');

                            const label = document.createElement('label');
                            label.classList.add('form-label');
                            label.textContent = `${color} - ${size}`;

                            const input = document.createElement('input');
                            input.type = 'number';
                            input.name = `stock[${color}-${size}]`;
                            input.classList.add('form-control');
                            input.placeholder = 'Products in Stock';
                            input.autocomplete = 'off';

                            field.appendChild(label);
                            field.appendChild(input);
                            stockFields.appendChild(field);
                        }
                    });
                }
            });
        }

        colorCheckboxes.forEach(colorCheckbox => {
            colorCheckbox.addEventListener('change', updateStockFields);
        });

        sizeCheckboxes.forEach(sizeCheckbox => {
            sizeCheckbox.addEventListener('change', updateStockFields);
        });
    </script>
    <script>
        const discountTypeRadios = document.querySelectorAll('input[name="discount-type"]');
        const discountedPriceField = document.getElementById('discountedPriceField');

        discountTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'discounted') {
                    discountedPriceField.style.display = 'block';
                } else {
                    discountedPriceField.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        const newProductRadios = document.querySelectorAll('input[name="new-product"]');
        const newProductField = document.getElementById('addNewProductField');

        newProductRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'add-new-product') {
                    newProductField.style.display = 'block';
                } else {
                    newProductField.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        const changeMediaRadios = document.querySelectorAll('input[name="change-media"]');
        const changeMediaField = document.getElementById('changeMediaField');

        changeMediaRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'change-media') {
                    changeMediaField.style.display = 'block';
                } else {
                    changeMediaField.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        FilePond.registerPlugin(FilePondPluginFileValidateType,FilePondPluginImagePreview);


        const inputElement = document.querySelector('input[id="media"]');

        const pond = FilePond.create(inputElement, {
            allowMultiple: true,
            allowFileValidate: true,
            acceptedFileTypes: ['image/jpeg', 'image/png'],
            server: {
                process: '/admin/upload/temp',
                revert: '/admin/delete/temp',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });

    </script>
@endsection
