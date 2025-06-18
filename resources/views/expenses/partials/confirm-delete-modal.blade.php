<!-- Confirmation Modal -->
<div
    class="fixed inset-0 z-50 overflow-y-auto" {{-- Keep these --}}
    x-show="confirmingDeletion"
    style="display: none;"
    x-cloak
>
    <!-- Background overlay -->
    <div x-show="confirmingDeletion"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 transition-opacity bg-gray-800 opacity-75" {{-- Simplified overlay --}}
         aria-hidden="true"
         @click="confirmingDeletion = false"
         >
    </div>

    <!-- Modal Centering Container (NEW) -->
    <div class="flex items-center justify-center min-h-screen px-4"> {{-- Use flex here JUST for centering the panel --}}

        <!-- Modal panel -->
        <div x-show="confirmingDeletion"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="modal-panel" {{-- Your existing styles for panel appearance --}}
             role="dialog" aria-modal="true" aria-labelledby="modal-headline"
             @click.away="confirmingDeletion = false" {{-- Also close if clicking away from panel --}}
             >
                <div class="modal-content">
                    <h2 class="modal-title" id="modal-headline">
                       Confirm Deletion
                    </h2>
                    <p class="modal-text">
                       Are you absolutely sure...? {{-- Rest of text --}}
                    </p>
                </div>
                <div class="modal-actions">
                     <button type="button" class="btn btn-secondary" @click="confirmingDeletion = false">Cancel</button>
                     <button type="button" class="btn btn-danger modal-delete-button"
                             @click="document.getElementById('delete-form-' + expenseIdToDelete).submit(); confirmingDeletion = false;">
                       Delete Expense
                     </button>
                </div>
        </div> <!-- End Modal Panel -->

    </div> <!-- End Modal Centering Container -->

</div> <!-- End Outermost Modal Div -->