<section>
     {{-- Ensure Alpine.js is available --}}
    <div x-data="{ confirmingUserDeletion: false }" @keydown.escape.window="confirmingUserDeletion = false">
        {{-- Trigger Button --}}
        <button @click="confirmingUserDeletion = true" class="btn btn-danger">
           Delete Account
        </button>

        <!-- Delete Account Confirmation Modal -->
        <div
            class="fixed inset-0 z-50 overflow-y-auto"
            x-show="confirmingUserDeletion"
            style="display: none;"
            x-cloak
            >
             <!-- Background overlay -->
            <div x-show="confirmingUserDeletion"
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="fixed inset-0 transition-opacity bg-gray-800 opacity-75" aria-hidden="true"
                 @click="confirmingUserDeletion = false"
                 ></div>

             <!-- Modal Centering Container -->
            <div class="flex items-center justify-center min-h-screen px-4">

                <!-- Modal panel -->
                <div x-show="confirmingUserDeletion"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="modal-panel" {{-- Reuse .modal-panel styles from CSS --}}
                     role="dialog" aria-modal="true" aria-labelledby="delete-modal-headline"
                     @click.away="confirmingUserDeletion = false" {{-- Close on click away --}}
                     >
                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')

                             <div class="modal-content"> {{-- Inner content wrapper --}}
                                <h2 class="modal-title" id="delete-modal-headline">
                                     Are you sure?
                                 </h2>
                                 <p class="modal-text">
                                     Confirming will permanently delete your account and all associated data. Please enter your password to proceed.
                                 </p>

                                 <div class="mt-6 form-group">
                                     <label for="password_delete_user" class="form-label sr-only">Password</label>
                                     <input
                                        id="password_delete_user" {{-- Unique ID for password field --}}
                                        name="password"
                                        type="password"
                                        class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                        placeholder="Password"
                                        required
                                    />
                                     @error('password', 'userDeletion')
                                        <div class="alert alert-danger validation-errors mt-2" role="alert" style="padding: 0.5rem 1rem; margin-bottom:0;">{{ $message }}</div>
                                     @enderror
                                 </div>
                            </div> {{-- End .modal-content --}}

                            <div class="modal-actions"> {{-- Use styles from other modal --}}
                                <button type="button" class="btn btn-secondary" @click="confirmingUserDeletion = false">
                                    Cancel
                               </button>
                                <button type="submit" class="btn btn-danger modal-delete-button"> {{-- Use specific class for styling if needed --}}
                                   Delete Account
                               </button>
                           </div>
                        </form>
                </div>{{-- End Modal Panel --}}

             </div>{{-- End Centering Container --}}

        </div> {{-- End Outermost Modal Div --}}

        {{-- Include Alpine JS CDN if not globally available --}}
         @once
           {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
         @endonce
         {{-- Include necessary base styles (fixed, inset-0 etc.) if not using Tailwind or if styles were removed --}}
         {{-- Add styles for .modal-panel, .modal-content, .modal-actions from previous expense modal CSS --}}
    </div>
</section>