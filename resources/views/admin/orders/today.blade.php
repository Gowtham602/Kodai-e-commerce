<x-admin-layout>
    <h2 class="mb-4">⚡ Today Orders</h2>

    <div class="card shadow-sm rounded-4">
        <div class="card-body table-responsive">

            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Time</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody id="todayOrdersTable">
                    @forelse ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>

                            <td>
                                {{ optional($order->user)->name ?? 'Guest' }}
                            </td>

                            <td>
                                ₹ {{ number_format($order->total, 2) }}
                            </td>

                             {{-- STATUS BADGE --}}
                    <td>
                        <span class="badge bg-{{ 
                            $order->status == 'delivered' ? 'success' :
                            ($order->status == 'cancelled' ? 'danger' : 'warning')
                        }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>

                            <td>
                                {{ $order->created_at->format('h:i A') }}
                            </td>

                            <td class="text-end">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                   class="btn btn-sm btn-outline-dark">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No orders placed today.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>
</x-admin-layout>
