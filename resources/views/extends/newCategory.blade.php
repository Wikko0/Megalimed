<form action="{{ route('admin.category.form') }}" method="post" enctype="multipart/form-data">
    @csrf

<div class="modal modal-blur fade" id="modal-category" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Your category name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Menu name</label>
                    <input type="text" class="form-control" name="menu" placeholder="Enter menu category name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Description..">
                </div>
                <div class="mb-3">
                    <label class="form-label">Url</label>
                    <div class="input-group">
                        <span class="input-group-text">{{ url('/shop') }}/</span>
                        <input type="text" class="form-control" name="url" placeholder="Enter URL">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-label">Image</div>
                    <input type="file" name="image" class="form-control" />
                </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary ms-auto" data-dismiss="modal">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    Create new category
                </button>
            </div>
        </div>
    </div>
</div>
</div>
</form>
