<x-admin-layout>

<h2 class="mb-4">Orders</h2>

<div class="card shadow-sm rounded-4">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#Order</th>
                    <th>Customer</th>
                    <th>Products</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>

                    <td>
                        <strong>{{ $order->customer_name }}</strong><br>
                        <small>{{ $order->customer_phone }}</small>
                    </td>

                    {{-- PRODUCTS WITH IMAGE --}}
                    <td>
                        <div class="d-flex gap-2">
                            @foreach($order->items as $item)
                                @if($item->product)
                                <img
                                    src="{{ asset('storage/'.$item->product->image) }}"
                                    class="rounded"
                                    width="45"
                                    height="45"
                                    style="object-fit:cover"
                                    title="{{ $item->product->name }}"
                                >
                                @endif
                            @endforeach
                        </div>
                    </td>

                    <td>₹{{ number_format($order->total,2) }}</td>

                    {{-- STATUS BADGE --}}
                    <td>
                        <span class="badge bg-{{ 
                            $order->status == 'delivered' ? 'success' :
                            ($order->status == 'cancelled' ? 'danger' : 'warning')
                        }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>

                    <td>{{ $order->created_at->format('d M Y') }}</td>

                    <td>
                        <a href="{{ route('admin.orders.show',$order) }}"
                           class="btn btn-sm btn-outline-primary">
                            View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="p-3">
        {{ $orders->links() }}
    </div>
</div>

</x-admin-layout>
