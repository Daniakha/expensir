@extends('layouts.app')

@section('content')

    <div class="content-header">
        <h2 class="content-title">Expense Overview</h2>
        <a href="{{ route('expenses.create') }}" class="btn btn-primary btn-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="18" height="18"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
            <span>Log New Expense</span>
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ session('error') }}</div>
    @endif

    {{-- Add Alpine.js context here for the modal --}}
    <div class="card" x-data="{ confirmingDeletion: false, expenseIdToDelete: null }">
        @if ($expenses->isEmpty())
            <p class="empty-state">No expenses logged yet.</p>
        @else
            <table class="table expense-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Date</th>
                        <th class="text-right">Amount</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                        <tr>
                            <td class="expense-description" data-label="Desc">{{ $expense->description }}</td>
                            <td class="expense-date" data-label="Date"><time datetime="{{ $expense->expense_date->toDateString() }}">{{ $expense->expense_date->format('M d, Y') }}</time></td>
                            <td class="expense-amount text-right" data-label="Amount">${{ number_format($expense->amount, 2) }}</td>
                            <td class="expense-actions text-center" data-label="Actions">
                                {{-- Edit Button remains the same --}}
                                <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-secondary btn-sm" title="Edit Expense" style="padding: 0.35rem 0.4rem; border-radius:50%; line-height:0; display:inline-flex; margin-right: 5px;">
                                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="14" height="14"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                </a>

                                {{-- Delete Form - REMOVE onsubmit, add unique id --}}
                                <form id="delete-form-{{ $expense->id }}" action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="delete-form" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    {{-- Delete Button - Change type to button, add @click directive --}}
                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm"
                                        title="Delete Expense"
                                        @click="confirmingDeletion = true; expenseIdToDelete = {{ $expense->id }}"
                                        >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="14" height="14"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        {{-- Include the Modal partial INSIDE the div with x-data --}}
        @include('expenses.partials.confirm-delete-modal')

    </div> {{-- End of .card with x-data --}}

     {{-- Include Alpine JS if not loaded globally by Vite/Breeze --}}
     @once
         <script src="//unpkg.com/alpinejs" defer></script>
     @endonce

@endsection