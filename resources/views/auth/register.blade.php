@extends('layouts.app')

@section('content')
<div class="auth-card">
     <div class="auth-logo">
        <a href="/">
             <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Expensir') }} Logo" class="app-logo">
        </a>
    </div>

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

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        {{-- Stacked action buttons --}}
        <div class="form-actions-stacked mt-4">
             {{-- Register Submit Button --}}
            <button type="submit" class="btn btn-primary btn-block">
                Confirm Registration
            </button>

             {{-- Already Registered? Button (styled as secondary/link-like) --}}
             <div class="text-center mt-3">
                 <a href="{{ route('login') }}" class="link" style="font-size: 0.9rem;">
                    Already registered? Log In
                 </a>
            </div>
        </div>
    </form>
</div>

{{-- Add style for form-actions-stacked if needed in app.css --}}
<style>
.form-actions-stacked {
    display: flex;
    flex-direction: column;
    gap: 1rem; /* Adjust spacing between stacked items */
    border-top: none; /* Override form-actions default if inheriting */
    padding-top: 0.5rem; /* Adjust spacing */
    margin-top: 2rem; /* Adjust spacing */
}
</style>
@endsection