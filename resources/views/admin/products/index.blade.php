<x-app-layout>
<div class="container my-5">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 p-4 rounded shadow-sm text-white"
         style="background: linear-gradient(135deg, #198754, #20c997);">
        <div>
            <h3 class="mb-1">Products Management</h3>
            <p class="mb-0 opacity-75">Manage all your products in one place</p>
        </div>

        <a href="{{ route('admin.products.create') }}"
           class="btn btn-light fw-semibold shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Add Product
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Products Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="fw-semibold text-muted">{{ $loop->iteration }}</td>

                        <td>
                            <div class="fw-semibold">{{ $product->name }}</div>
                        </td>

                        <td>
                            <span class="badge bg-secondary-subtle text-dark">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </span>
                        </td>

                        <td class="fw-bold text-success">
                            ₹{{ number_format($product->price, 2) }}
                        </td>

                        <td class="text-end">
                            <a href="{{ route('admin.products.edit', $product) }}"
                               class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.products.destroy', $product) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this product?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if($products->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            No products found
                        </td>
                    </tr>
                    @endif
                </tbody>

            </table>

        </div>
    </div>
</div>

<!-- Custom Premium CSS -->
<style>
    table tbody tr {
        transition: background 0.2s ease;
    }

    table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .btn-outline-primary:hover,
    .btn-outline-danger:hover {
        color: #fff;
    }
</style>
</x-app-layout>
