@extends('layouts.app')

@section('content')
    <div class="content-header border-bottom">
         <h2 class="content-title">Edit Expense Record</h2>
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

        <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="description" class="form-label">Expense Description</label>
                <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $expense->description) }}" required>
            </div>
            <div class="form-row">
                 <div class="form-group form-group-inline">
                    <label for="amount" class="form-label">Amount</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                         <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" step="0.01" min="0.01" max="999999.99" value="{{ old('amount', $expense->amount) }}" required>
                    </div>
                 </div>
                 <div class="form-group form-group-inline">
                    <label for="expense_date" class="form-label">Date of Expense</label>
                    <input type="date" name="expense_date" id="expense_date" class="form-control @error('expense_date') is-invalid @enderror" value="{{ old('expense_date', $expense->expense_date->format('Y-m-d')) }}" required max="{{ date('Y-m-d') }}">
                 </div>
            </div>
            <div class="form-actions">
                 <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="18" height="18"> <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path> </svg>
                    <span>Update Expense</span>
                </button>
            </div>
        </form>
    </div>
@endsection