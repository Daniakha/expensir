<section>
     <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="current_password" class="form-label">Current Password</label>
            <input id="current_password" name="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password" />
             @error('current_password', 'updatePassword')
                 <div class="alert alert-danger validation-errors mt-2" role="alert">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">New Password</label>
            <input id="password" name="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password" />
             @error('password', 'updatePassword')
                 <div class="alert alert-danger validation-errors mt-2" role="alert">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
        </div>

        <div class="form-actions flex items-center">
             <button type="submit" class="btn btn-primary">Save Password</button>

             @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="status-message"
                >Saved.</p>
                  {{-- Needs Alpine.js or manual JS for fade out --}}
                 {{-- Without Alpine: <span class="status-message">Saved.</span> --}}
            @endif
        </div>
    </form>
     {{-- Ensure Alpine is available if using x-data --}}
    {{-- If not using Vite/Alpine from Breeze, remove x-data logic and just show static 'Saved.' message --}}
    @once
     <script src="//unpkg.com/alpinejs" defer></script>
    @endonce
</section>