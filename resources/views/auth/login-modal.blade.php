<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    @if ($errors->any())
                        {{-- <div class="text-danger small mb-2">
                            Invalid email or password
                        </div> --}}
                        <div class="alert alert-danger small mb-3">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <button class="btn btn-success w-100">
                        Login
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
