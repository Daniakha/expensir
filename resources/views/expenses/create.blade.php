@extends('layouts.app')

@section('content')
    <div class="content-header border-bottom">
         <h2 class="content-title">Log New Expense</h2>
    </div>

     <div class="card form-card">
        @if ($errors->any())
            <div class="alert alert-danger validation-errors" role="alert">
                <strong class="error-title">Error:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
         @if (session('error'))
             <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
         @endif

        <form action="{{ route('expenses.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="description" class="form-label">Expense Description</label>
                <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" required placeholder="e.g., Client Lunch, Office Supplies">
            </div>
            <div class="form-row">
                 <div class="form-group form-group-inline">
                    <label for="amount" class="form-label">Amount</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                         <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" step="0.01" min="0.01" max="999999.99" value="{{ old('amount') }}" required placeholder="0.00">
                    </div>
                 </div>
                 <div class="form-group form-group-inline">
                    <label for="expense_date" class="form-label">Date of Expense</label>
                    <input type="date" name="expense_date" id="expense_date" class="form-control @error('expense_date') is-invalid @enderror" value="{{ old('expense_date', date('Y-m-d')) }}" required max="{{ date('Y-m-d') }}">
                 </div>
            </div>
            <div class="form-actions">
                 <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="18" height="18"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    <span>Save Expense</span>
                </button>
            </div>
        </form>
    </div>
@endsection