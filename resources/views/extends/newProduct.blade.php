<form action="{{ route('admin.product.form') }}" method="post" enctype="multipart/form-data">
    @csrf

<div class="modal modal-blur fade" id="modal-product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Your category name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Barcode</label>
                    <input type="text" name="barcode" class="form-control" data-mask="00000000" data-mask-visible="true" placeholder="Barcode example: 00000000 " autocomplete="off"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control"
                              rows="5"
                              name="description">Big belly rude boy, million dollar hustler. Unemployed.</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Specification</label>
                    <textarea class="form-control"
                              rows="5"
                              name="specification">Big belly rude boy, million dollar hustler. Unemployed.</textarea>
                </div>
        </div>

            <div class="modal-body">
                <h5 class="modal-title">Pricing</h5>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" placeholder="Price">
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
                    <input type="number" class="form-control" name="discount" placeholder="Discounted Price">
                </div>

            </div>

            <div class="modal-body">
                <h5 class="modal-title">Organize</h5>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        @foreach($categoryProvider as $values)
                        <option value="{{$values->id}}">{{$values->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="modal-body">
                <h5 class="modal-title">Variants</h5>
                <div class="mb-3">
                    <label class="form-label">Colors</label>
                    <div class="form-selectgroup">
                    <label class="form-selectgroup-item">
                        <input type="checkbox" name="color[]" value="Black" class="form-selectgroup-input">
                        <span class="form-selectgroup-label">Black</span>
                    </label>
                    <label class="form-selectgroup-item">
                        <input type="checkbox" name="color[]" value="White" class="form-selectgroup-input">
                        <span class="form-selectgroup-label">White</span>
                    </label>
                    <label class="form-selectgroup-item">
                        <input type="checkbox" name="color[]" value="Red" class="form-selectgroup-input">
                        <span class="form-selectgroup-label">Red</span>
                    </label>
                    <label class="form-selectgroup-item">
                        <input type="checkbox" name="color[]" value="Green" class="form-selectgroup-input">
                        <span class="form-selectgroup-label">Green</span>
                    </label>
                    <label class="form-selectgroup-item">
                        <input type="checkbox" name="color[]" value="Blue" class="form-selectgroup-input">
                        <span class="form-selectgroup-label">Blue</span>
                    </label>
                    <label class="form-selectgroup-item">
                        <input type="checkbox" name="color[]" value="Yellow" class="form-selectgroup-input">
                        <span class="form-selectgroup-label">Yellow</span>
                    </label>
                    <label class="form-selectgroup-item">
                        <input type="checkbox" name="color[]" value="Purple" class="form-selectgroup-input">
                        <span class="form-selectgroup-label">Purple</span>
                    </label>
                    <label class="form-selectgroup-item">
                        <input type="checkbox" name="color[]" value="Orange" class="form-selectgroup-input">
                        <span class="form-selectgroup-label">Orange</span>
                    </label>
                    <label class="form-selectgroup-item">
                        <input type="checkbox" name="color[]" value="Pink" class="form-selectgroup-input">
                        <span class="form-selectgroup-label">Pink</span>
                    </label>
                    <label class="form-selectgroup-item">
                        <input type="checkbox" name="color[]" value="Brown" class="form-selectgroup-input">
                        <span class="form-selectgroup-label">Brown</span>
                    </label>
                    <label class="form-selectgroup-item">
                        <input type="checkbox" name="color[]" value="Gray" class="form-selectgroup-input">
                        <span class="form-selectgroup-label">Gray</span>
                    </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Size</label>
                    <div class="form-selectgroup">
                        <label class="form-selectgroup-item">
                            <input type="checkbox" name="size[]" value="XXS" class="form-selectgroup-input" data-target="size-XXS-field">
                            <span class="form-selectgroup-label">XXS</span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="checkbox" name="size[]" value="XS" class="form-selectgroup-input" data-target="size-XS-field">
                            <span class="form-selectgroup-label">XS</span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="checkbox" name="size[]" value="S" class="form-selectgroup-input" data-target="size-S-field">
                            <span class="form-selectgroup-label">S</span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="checkbox" name="size[]" value="M" class="form-selectgroup-input" data-target="size-M-field">
                            <span class="form-selectgroup-label">M</span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="checkbox" name="size[]" value="L" class="form-selectgroup-input" data-target="size-L-field">
                            <span class="form-selectgroup-label">L</span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="checkbox" name="size[]" value="XL" class="form-selectgroup-input" data-target="size-XL-field">
                            <span class="form-selectgroup-label">XL</span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="checkbox" name="size[]" value="XXL" class="form-selectgroup-input" data-target="size-XXL-field">
                            <span class="form-selectgroup-label">XXL</span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="checkbox" name="size[]" value="XXXL" class="form-selectgroup-input" data-target="size-XXXL-field">
                            <span class="form-selectgroup-label">XXXL</span>
                        </label>
                    </div>
                </div>

            <div class="modal-body">
                <h5 class="modal-title">Media</h5>
                <div class="mb-8">

                    <input type="file" name="media" id="media" accept="image/jpeg, image/png" multiple />

                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary ms-auto" data-dismiss="modal">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    Create new product
                </button>
            </div>
    </div>
</div>
</div>
</form>
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
