<x-guest-layout>
    <style>
        :root {
            --brand: #198754;
            --brand-dark: #0f5132;
            --bg: #f8fafc;
            --text-dark: #111827;
            --text-muted: #6b7280;
        }

        body {
            background: var(--bg);
        }

        .auth-card {
            max-width: 420px;
            margin: auto;
            background: #fff;
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }

        .auth-title {
            font-weight: 800;
            color: var(--text-dark);
        }

        .auth-desc {
            font-size: 14px;
            color: var(--text-muted);
        }

        .btn-brand {
            background: linear-gradient(135deg, var(--brand), var(--brand-dark));
            border-radius: 999px;
            font-weight: 700;
            padding: 10px 18px;
        }
    </style>

    <div class="auth-card">
        <h2 class="auth-title mb-2">Forgot Password 🔐</h2>
        <p class="auth-desc mb-4">
            Enter your email and we’ll send you a secure password reset link.
        </p>

        <!-- Success message -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <x-input-label for="email" :value="__('Email address')" />
                <x-text-input
                    id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <button class="btn btn-success w-100 btn-brand">
                Send Reset Link
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="text-success fw-semibold small">
                ← Back to Home
            </a>
        </div>
    </div>
</x-guest-layout>
