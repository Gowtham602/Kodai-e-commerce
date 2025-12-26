<div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- HEADER -->
            <div class="modal-header border-0 text-white"
                 style="background: linear-gradient(135deg, #198754, #20c997);">
                <h5 class="modal-title fw-semibold">Create Your Account ✨</h5>
                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4">

                <p class="text-muted small mb-4">
                    Join <strong>Kodai Specials</strong> and enjoy exclusive deals
                </p>

                {{-- Validation Errors --}}
                @if ($errors->getBag('register')->any())
                    <div class="alert alert-danger small d-flex align-items-start">
                        <i class="bi bi-exclamation-triangle-fill me-2 mt-1"></i>
                        <div>
                            @foreach ($errors->getBag('register')->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div id="registerErrors" class="alert alert-danger d-none"></div>


                {{-- <form method="POST" action="{{ route('register') }}"> --}}
                    <form id="registerForm">

                    @csrf

                    <!-- Name -->
                    <div class="form-floating mb-3">
                        <input type="text"
                               name="name"
                               id="regName"
                               class="form-control"
                               placeholder="Your Name"
                               value="{{ old('name') }}"
                               required autofocus>
                        <label for="regName">
                            <i class="bi bi-person me-1"></i>Full Name
                        </label>
                    </div>

                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input type="email"
                               name="email"
                               id="regEmail"
                               class="form-control"
                               placeholder="name@example.com"
                               value="{{ old('email') }}"
                               required>
                        <label for="regEmail">
                            <i class="bi bi-envelope me-1"></i>Email Address
                        </label>
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <input type="password"
                               name="password"
                               id="regPassword"
                               class="form-control"
                               placeholder="Password"
                               required>
                        <label for="regPassword">
                            <i class="bi bi-lock me-1"></i>Password
                        </label>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-floating mb-3">
                        <input type="password"
                               name="password_confirmation"
                               id="regPasswordConfirm"
                               class="form-control"
                               placeholder="Confirm Password"
                               required>
                        <label for="regPasswordConfirm">
                            <i class="bi bi-shield-lock me-1"></i>Confirm Password
                        </label>
                    </div>

                    <!-- Action -->
                    <button type="submit"
                            class="btn btn-success w-100 py-2 fw-semibold rounded-pill">
                        Create Account
                    </button>
                </form>

                <!-- Footer -->
                <div class="text-center mt-4">
                    <span class="small text-muted">Already have an account?</span>
                    <a href="javascript:void(0)"
                       class="fw-semibold text-success text-decoration-none"
                       data-bs-dismiss="modal"
                       data-bs-toggle="modal"
                       data-bs-target="#loginModal">
                        Login
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- @if ($errors->getBag('register')->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    new bootstrap.Modal(
        document.getElementById('registerModal'),
        { backdrop: 'static', keyboard: false }
    ).show();
});
</script> --}}
{{-- @endif --}}
<script>
document.getElementById('registerForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = this;
    const errorBox = document.getElementById('registerErrors');
    errorBox.classList.add('d-none');
    errorBox.innerHTML = '';

    const res = await fetch("{{ route('register') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: new FormData(form)
    });

    const data = await res.json();

    if (!res.ok) {
        Object.values(data.errors).forEach(err => {
            errorBox.innerHTML += `<div>${err[0]}</div>`;
        });
        errorBox.classList.remove('d-none');
        return;
    }

    // SUCCESS
    bootstrap.Modal.getInstance(
        document.getElementById('registerModal')
    ).hide();
    setTimeout(() => {
    window.location.reload();
}, 500);

    alert(data.message); // replace with toast later
});
</script>


