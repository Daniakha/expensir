<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" >
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input id="name" name="name" type="text" class="form-control @error('name', 'updateProfileInformation') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name', 'updateProfileInformation')
                 <div class="alert alert-danger validation-errors mt-2" role="alert">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email" class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username" />
             @error('email', 'updateProfileInformation')
                 <div class="alert alert-danger validation-errors mt-2" role="alert">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm" style="font-size: 0.85rem; color: var(--color-text-secondary);">
                        Your email address is unverified.
                        <button form="send-verification" class="link" style="font-size: 0.85rem;">
                           Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 alert alert-success" style="padding: 0.5rem 1rem;">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="form-actions flex items-center">
            <button type="submit" class="btn btn-primary">Save Changes</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="status-message"
                >Saved.</p>
                 {{-- Simple status: needs Alpine.js (included via Breeze) or manual JS to fade out --}}
                  {{-- Without Alpine: <span class="status-message">Saved.</span> --}}
            @endif
        </div>
    </form>
     {{-- Ensure Alpine is available if using x-data --}}
    {{-- If not using Vite/Alpine from Breeze, remove x-data logic and just show static 'Saved.' message --}}
     <script src="//unpkg.com/alpinejs" defer></script> {{-- Quick include for Alpine if needed --}}
</section>