<!-- 
    <style>

        /* ================= STICKY CART BAR ================= */
.sticky-cart {
    position: fixed;
    bottom: 12px;
    left: 0;
    right: 0;
    z-index: 1050;
}
@media (min-width: 768px) {
    .sticky-cart { display: none !important; }
}

.sticky-cart .container {
    background: #1a7f4b;
    color: #fff;
    border-radius: 16px;
    padding: 12px 16px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.25);
}

.sticky-cart .btn {
    border-radius: 999px;
    padding: 6px 14px;
}

/* Hide on desktop (optional) */
@media (min-width: 768px) {
    .sticky-cart {
        display: none !important;
    }
}

    </style>

{{-- STICKY CART BAR (MOBILE FIRST) --}}
<div id="stickyCartBar" class="sticky-cart py-5 d-none">
    <div class="container d-flex align-items-center justify-content-between">
        <div>
            <strong>View cart</strong><br>
            <small>
                <span id="stickyCartCount">0</span> items
            </small>
        </div>

        <a href="{{ route('cart.index') }}" class="btn btn-light btn-sm fw-bold">
            Open
        </a>
    </div>
</div>




 -->
