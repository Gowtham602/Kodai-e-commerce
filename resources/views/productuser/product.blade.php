<x-app-layout>

<div class="container-fluid py-4">
    <div class="row g-4">

        {{-- SIDEBAR --}}
        <div class="col-lg-3 col-md-4">
            <!-- <div class="card shadow-sm sticky-top" style="top:90px"> -->
            <div class="card shadow-sm sticky">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Filters</h5>

                    @foreach($categories as $cat)
    <div class="form-check mb-2">
        <input
            class="form-check-input category-filter"
            type="checkbox"
            value="{{ $cat->id }}"
            id="cat-{{ $cat->id }}"
        >
        <label class="form-check-label" for="cat-{{ $cat->id }}">
            {{ $cat->name }}
        </label>
    </div>
@endforeach
                </div>
            </div>
        </div>

        {{-- PRODUCTS --}}
        <div class="col-lg-9 col-md-8">
            <div class="row g-4" id="product-list">
                @foreach($products as $product)
                    @include('productuser.cartsui', ['product' => $product])
                @endforeach
            </div>
        </div>

    </div>
</div>

</x-app-layout>
