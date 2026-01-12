<x-admin-layout>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Add New Product
                    </h4>
                </div>

                <div class="card-body">

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"> -->
                  <form id="productCreateForm"
      action="{{ route('admin.products.store') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf
                        <div class="row">

                            {{-- Category --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Category <span class="text-danger">*</span>
                                </label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Price --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Price (₹) <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="price" class="form-control" placeholder="Enter price" required>
                            </div>

                        </div>

                        {{-- Product Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Product Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                        </div>

                        <div class="row">

                            {{-- Weight --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Weight / Size
                                </label>
                                <input type="text" name="weight" class="form-control" placeholder="250g / 100ml">
                            </div>

                            {{-- Image --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Product Image
                                </label>
                                <input type="file" name="image" class="form-control" accept="image/png,image/jpeg,image/webp">
                                <small class="text-muted">
                                    JPG, PNG, WEBP (Max 2MB)
                                </small>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="reset" class="btn btn-outline-secondary">
                                Reset
                            </button>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-1"></i>
                                Save Product
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</x-admin-layout>
