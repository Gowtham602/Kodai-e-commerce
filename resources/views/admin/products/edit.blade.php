<x-admin-layout>
<div class="container my-5">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Edit Product</h3>
            <p class="text-muted mb-0">Update product details</p>
        </div>

        <a href="{{ route('admin.products.index') }}"
           class="btn btn-outline-secondary">
            ← Back to Products
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">

        {{-- IMAGE PREVIEW --}}
        <div class="col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light fw-semibold">
                    Product Image
                </div>

                <div class="card-body text-center">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}"
                             class="img-fluid rounded mb-3"
                             style="max-height:220px;">
                    @else
                        <div class="text-muted py-5">
                            No image uploaded
                        </div>
                    @endif

                    <small class="text-muted">
                        Recommended size: 800×800px
                    </small>
                </div>
            </div>
        </div>

        {{-- FORM --}}
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white fw-semibold">
                    Product Information
                </div>

                <div class="card-body">
                    <!-- <form action="{{ route('admin.products.update', $product) }}" -->
                  <form id="productEditForm"
      action="{{ route('admin.products.update', $product) }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')
                        <div class="row g-3">

                            {{-- Category --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Category</label>
                                <select name="category_id" class="form-select" required>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Price --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Price (₹)</label>
                                <input type="number"
                                       name="price"
                                       value="{{ $product->price }}"
                                       class="form-control"
                                       required>
                            </div>

                            {{-- Name --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">Product Name</label>
                                <input type="text"
                                       name="name"
                                       value="{{ $product->name }}"
                                       class="form-control"
                                       required>
                            </div>

                            {{-- Weight --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Weight / Size</label>
                                <input type="text"
                                       name="weight"
                                       value="{{ $product->weight }}"
                                       class="form-control"
                                       placeholder="250g / 1kg / 100ml">
                            </div>

                            {{-- Image Upload --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Change Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                        </div>

                        {{-- ACTION BUTTONS --}}
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.products.index') }}"
                               class="btn btn-outline-secondary">
                                Cancel
                            </a>

                            <button class="btn btn-warning px-4">
                                <i class="fas fa-save me-1"></i>
                                Update Product
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

</x-admin-layout>