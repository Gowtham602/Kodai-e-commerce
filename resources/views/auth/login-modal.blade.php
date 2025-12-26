<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- HEADER -->
            <div class="modal-header border-0 text-white"
                 style="background: linear-gradient(135deg, #198754, #20c997);">
                <h5 class="modal-title fw-semibold">Welcome Back 👋</h5>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4">

                <p class="text-muted small mb-4">
                    Login to continue shopping at <strong>Kodai Specials</strong>
                </p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input type="email"
                               name="email"
                               class="form-control"
                               id="loginEmail"
                               placeholder="name@example.com"
                               required>
                        <label for="loginEmail">
                            <i class="bi bi-envelope me-1"></i>Email address
                        </label>
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <input type="password"
                               name="password"
                               class="form-control"
                               id="loginPassword"
                               placeholder="Password"
                               required>
                        <label for="loginPassword">
                            <i class="bi bi-lock me-1"></i>Password
                        </label>
                    </div>

                    <!-- Error -->
                    @if ($errors->getBag('login')->any())
                        <div class="alert alert-danger small d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ $errors->getBag('login')->first() }}
                        </div>
                    @endif

                    <!-- Action -->
                    <button type="submit"
                            class="btn btn-success w-100 py-2 fw-semibold rounded-pill">
                        Login Securely
                    </button>
                </form>

                <!-- Footer Links -->
                <div class="text-center mt-4">
                    <span class="small text-muted">
                        Don’t have an account?
                    </span>
                    <a href="javascript:void(0)"
                       class="fw-semibold text-success text-decoration-none"
                       data-bs-dismiss="modal"
                       data-bs-toggle="modal"
                       data-bs-target="#registerModal">
                        Register
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Auto-open on error --}}
{{-- @if ($errors->getBag('login')->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    new bootstrap.Modal(document.getElementById('loginModal')).show();
});
</script> --}}
{{-- @endif --}}
@if ($errors->getBag('login')->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    new bootstrap.Modal(
        document.getElementById('loginModal'),
        { backdrop: 'static', keyboard: false }
    ).show();
});
</script>
@endif

