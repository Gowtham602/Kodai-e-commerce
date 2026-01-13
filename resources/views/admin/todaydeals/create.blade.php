<x-admin-layout>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<div class="container py-4">
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-7 col-md-9 col-sm-12">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <!-- Header -->
                <div class="bg-warning text-white px-4 py-3">
                    <h5 class="mb-0 fw-semibold">
                        🔥 Create Today Deal
                    </h5>
                    <small class="opacity-75">
                        Configure limited-time offers for homepage
                    </small>
                </div>

                <!-- Body -->
                <div class="card-body p-4">

                    @if(session('success'))
                        <div class="alert alert-success rounded-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.today-deals.store') }}">
                        @csrf

                        <!-- Product -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Select Product
                            </label>
                            <select name="product_id" class="form-select rounded-3" required>
                                <option value="">-- Choose Product --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Deal Price -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Deal Price (₹)
                            </label>
                            <input
                                type="number"
                                name="deal_price"
                                class="form-control rounded-3"
                                placeholder="Enter discounted price"
                                required
                            >
                        </div>

                        <!-- Time Section -->
                        <div class="row g-3">
                            <div class="col-md-6 col-12">
                                <label class="form-label fw-semibold">
                                    Start Time
                                </label>
                                <input
                                    type="datetime-local"
                                    name="start_time"
                                    class="form-control rounded-3"
                                    required
                                >
                            </div>

                            <div class="col-md-6 col-12">
                                <label class="form-label fw-semibold">
                                    End Time
                                </label>
                                <input
                                    type="datetime-local"
                                    name="end_time"
                                    class="form-control rounded-3"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-warning btn-lg rounded-pill">
                                Save Today Deal
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>

</x-admin-layout>
