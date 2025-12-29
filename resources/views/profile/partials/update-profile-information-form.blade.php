<section class="max-w-5xl mx-auto px-4 sm:px-6">

    <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden">

        <!-- ACCENT STRIP -->
        <div class="absolute left-0 top-0 h-full w-1.5 bg-gradient-to-b from-emerald-500 to-emerald-300"></div>

        <div class="p-6 sm:p-10">

            <!-- HEADER -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">
                        Profile Settings
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Manage your personal information & account email
                    </p>
                </div>

                <!-- <span class="inline-flex items-center gap-2 text-xs font-semibold px-3 py-1.5 rounded-full
                    {{ $user->hasVerifiedEmail() ? 'bg-emerald-50 text-emerald-700' : 'bg-yellow-50 text-yellow-700' }}">
                    ● {{ $user->hasVerifiedEmail() ? 'Verified Account' : 'Email Not Verified' }}
                </span> -->
            </div>

            <!-- SEND VERIFICATION -->
            <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <!-- FORM -->
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-8">
                @csrf
                @method('patch')

                <!-- INFO GRID -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <!-- NAME -->
                    <div class="space-y-1">
                        <x-input-label for="name" :value="__('Full Name')" />
                        <x-text-input
                            id="name"
                            name="name"
                            type="text"
                            class="block w-full rounded-xl border-gray-200 focus:ring-emerald-500 focus:border-emerald-500"
                            :value="old('name', $user->name)"
                            required
                            autocomplete="name"
                        />
                        <x-input-error class="mt-1" :messages="$errors->get('name')" />
                    </div>

                    <!-- EMAIL -->
                    <div class="space-y-1">
                        <x-input-label for="email" :value="__('Email Address')" />
                        <x-text-input
                            id="email"
                            name="email"
                            type="email"
                            class="block w-full rounded-xl border-gray-200 focus:ring-emerald-500 focus:border-emerald-500"
                            :value="old('email', $user->email)"
                            required
                        />
                        <x-input-error class="mt-1" :messages="$errors->get('email')" />
                    </div>

                </div>
                                                                                                                                                                                
                <!-- EMAIL WARNING -->
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4
                        bg-amber-50 border border-amber-200 rounded-2xl p-4">

                        <p class="text-sm text-amber-800">
                            Your email is not verified. Verify it to secure your account.
                        </p>

                        <button
                            form="send-verification"
                            class="inline-flex items-center justify-center px-4 py-2
                            text-sm font-semibold rounded-xl bg-amber-600 text-white hover:bg-amber-700 transition">
                            Send Verification
                        </button>
                    </div>
                @endif

                <!-- ACTIONS -->
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 rounded-xl
                        bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition w-full sm:w-auto">
                        Save Changes
                    </button>

                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-emerald-600 font-medium">
                            ✔ Profile updated successfully
                        </p>
                    @endif

                </div>

            </form>

        </div>
    </div>

</section>
