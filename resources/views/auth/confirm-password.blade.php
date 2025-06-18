@extends('layouts.app')

@section('content')
<div class="auth-card">
     <div class="auth-logo">
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Expensir') }} Logo" class="app-logo">
        </a>
    </div>

    <div class="mb-4 text-sm" style="color: var(--color-text-secondary);">
         This is a secure area of the application. Please confirm your password before continuing.
    </div>

      <!-- Validation Errors -->
     @if ($errors->any())
        <div class="alert alert-danger validation-errors mb-4" role="alert">
            <strong class="error-title">Error:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
             <input id="password" class="form-control"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="btn btn-primary">
                Confirm
            </button>
        </div>
    </form>
</div>
@endsection