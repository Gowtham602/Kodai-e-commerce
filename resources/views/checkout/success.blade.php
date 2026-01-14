<x-app-layout>

<style>
:root {
    --brand: #f59e0b;
    --brand-dark: #d97706;
    --bg-soft: #f9fafb;
    --text-dark: #111827;
    --text-muted: #6b7280;
}

/* PAGE CENTER */
.success-wrapper {
    min-height: 75vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

/* CARD */
.success-card {
    background: #ffffff;
    border-radius: 26px;
    padding: 38px 30px;
    max-width: 420px;
    width: 100%;
    text-align: center;
    box-shadow: 0 22px 60px rgba(0,0,0,0.14);
    animation: fadeUp .6s ease;
}

/* CHECK ICON */
.success-icon {
    width: 88px;
    height: 88px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f59e0b, #d97706);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
    color: #ffffff;
    font-size: 42px;
    box-shadow: 0 14px 32px rgba(245, 158, 11, 0.45);
}


/* TEXT */
.success-title {
    font-size: 22px;
    font-weight: 900;
    color: var(--text-dark);
}

.success-sub {
    font-size: 14px;
    color: var(--text-muted);
    margin-top: 6px;
    margin-bottom: 24px;
}

/* ORDER BOX */
.order-box {
    background: var(--bg-soft);
    border-radius: 18px;
    padding: 18px;
    margin-bottom: 26px;
}

.order-row {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    margin-bottom: 10px;
}

.order-row strong {
    color: var(--text-dark);
}

.order-total {
    font-size: 18px;
    font-weight: 900;
    margin-top: 10px;
}

/* BUTTON */
.success-btn {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    border-radius: 16px;
    padding: 14px;
    font-size: 15px;
    font-weight: 800;
    box-shadow: 0 14px 30px rgba(245, 158, 11, 0.45);
    transition: all .2s ease;
}


.success-btn:hover {
    transform: translateY(-2px);
}

/* FOOT NOTE */
.success-note {
    font-size: 12px;
    color: var(--text-muted);
    margin-top: 18px;
}

/* ANIMATION */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* MOBILE */
@media (max-width: 576px) {
    .success-card {
        padding: 28px 22px;
    }
}
</style>

<div class="success-wrapper">

    <div class="success-card">

        {{-- ACCESS PROTECTION --}}
        @unless(session('order_placed'))
            <script>window.location = "{{ route('home') }}";</script>
        @endunless

        {{-- ICON --}}
        <div class="success-icon">✓</div>

        {{-- TITLE --}}
        <div class="success-title">
            Order Placed Successfully
        </div>

        <div class="success-sub">
            Thank you for shopping with <strong>Kodai Choco</strong>
        </div>

        {{-- ORDER DETAILS --}}
        <div class="order-box">
            <div class="order-row">
                <span>Order ID</span>
                <strong>{{ $order->order_number }}</strong>
            </div>

            <div class="order-row">
                <span>Payment Method</span>
                <strong>{{ strtoupper($order->payment_method) }}</strong>
            </div>

            <hr>

            <div class="order-row order-total">
                <span>Total Paid</span>
                <span>₹{{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        {{-- ACTION --}}
        <a href="{{ route('home') }}" class="btn btn-warning w-100 success-btn">
            CONTINUE SHOPPING
        </a>

        <div class="success-note">
            Order confirmation has been sent to your email 📧
        </div>

    </div>

</div>

</x-app-layout>
