{{-- Assumes no specific guest layout is needed, uses app layout directly --}}
@extends('layouts.app')

@section('content')
<div class="auth-card">
    <div class="auth-logo">
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Expensir') }} Logo" class="app-logo">
        </a>
    </div>

     <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 alert alert-success">
            {{ session('status') }}
        </div>
    @endif

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

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
        </div>

        <div class="form-group">
             <div class="flex justify-between items-center mb-1">
                 <label for="password" class="form-label" style="margin-bottom: 0;">Password</label>
                 @if (Route::has('password.request'))
                    <a class="link" style="font-size:0.8rem;" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="form-group">
            <label for="remember_me" class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                 <span class="checkmark"></span>
                <span class="form-check-label" style="padding-left: 0.2rem;">Remember me</span>
            </label>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary btn-block">
                Log in
            </button>
        </div>

        @if (Route::has('register'))
         <p class="text-center mt-4" style="font-size:0.9rem; color: var(--color-text-secondary);">
             Don't have an account? <a href="{{ route('register') }}" class="link">Register</a>
        </p>
        @endif
    </form>
</div>
@endsection