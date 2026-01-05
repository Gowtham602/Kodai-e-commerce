<x-app-layout>

<style>
.success-wrapper {
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.success-card {
    background: #ffffff;
    border-radius: 24px;
    padding: 36px 28px;
    max-width: 420px;
    width: 100%;
    text-align: center;
    box-shadow: 0 20px 50px rgba(0,0,0,0.12);
}

.success-icon {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: linear-gradient(135deg, #16a34a, #22c55e);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    color: #fff;
    font-size: 42px;
    box-shadow: 0 12px 30px rgba(34,197,94,0.45);
}

.success-title {
    font-size: 22px;
    font-weight: 900;
    color: #111827;
    margin-bottom: 8px;
}

.success-sub {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 22px;
}

.order-box {
    background: #f9fafb;
    border-radius: 16px;
    padding: 18px;
    margin-bottom: 24px;
}

.order-row {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    margin-bottom: 10px;
}

.order-row strong {
    color: #111827;
}

.order-total {
    font-size: 18px;
    font-weight: 900;
    color: #111827;
}

.success-btn {
    background: linear-gradient(135deg, #198754, #0f5132);
    border-radius: 14px;
    padding: 14px;
    font-size: 15px;
    font-weight: 800;
    box-shadow: 0 14px 30px rgba(25,135,84,0.45);
}

.success-note {
    font-size: 12px;
    color: #6b7280;
    margin-top: 16px;
}

/* Mobile spacing */
@media (max-width: 576px) {
    .success-card {
        padding: 28px 20px;
    }
}
</style>

<div class="success-wrapper">
    <div class="success-card">

        {{--  ICON --}}
        <div class="success-icon">
            ✓
        </div>

        {{--  TITLE --}}
        <div class="success-title">
            Order Placed Successfully
        </div>

        <div class="success-sub">
            Thank you for shopping with <strong>Kodai Specials</strong>
        </div>

        {{--  ORDER DETAILS --}}
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
                <span>₹{{ $order->total }}</span>
            </div>
        </div>

        {{--  ACTIONS --}}
        <a href="{{ route('home') }}" class="btn btn-success w-100 success-btn">
            CONTINUE SHOPPING
        </a>

        <div class="success-note">
             <!-- Order confirmation will be sent to your registered email. -->
        </div>

    </div>
</div>

</x-app-layout>


