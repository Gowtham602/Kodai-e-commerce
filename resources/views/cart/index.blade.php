<x-app-layout>
<div class="container py-5">
    <div class="row">

        <div class="col-lg-8">
            <h4>Cart Items ( {{ count(session('cart', [])) }} )</h4>

            @foreach(session('cart', []) as $item)
                <div class="card mb-3 p-3 shadow-sm">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('storage/'.$item['image']) }}" width="80">

                        <div class="flex-grow-1">
                            <h6>{{ $item['name'] }}</h6>
                            <p>₹{{ $item['price'] }} × {{ $item['qty'] }}</p>
                        </div>

                        <h5>₹{{ $item['price'] * $item['qty'] }}</h5>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-lg-4">
            <div class="card p-4 shadow">
                <h5>Order Summary</h5>

                @php
                    $subtotal = collect(session('cart', []))
                        ->sum(fn($i) => $i['price'] * $i['qty']);
                    $tax = $subtotal * 0.05;
                @endphp

                <p>Subtotal: ₹{{ $subtotal }}</p>
                <p>Tax (5%): ₹{{ $tax }}</p>
                <hr>
                <h4>Total: ₹{{ $subtotal + $tax }}</h4>
            </div>
        </div>

    </div>
</div>
</x-app-layout>
