@extends('layouts.app')

@section('content')
<div class="auth-card">
    <div class="auth-logo">
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Expensir') }} Logo" class="app-logo">
        </a>
    </div>

    <div class="mb-4 text-sm" style="color: var(--color-text-secondary);">
       Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
    </div>

    <!-- Session Status -->
     @if (session('status'))
        <div class="mb-4 alert alert-success" role="alert">
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


    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="btn btn-primary btn-block">
                Email Password Reset Link
            </button>
        </div>

         <p class="text-center mt-4" style="font-size:0.9rem;">
            <a href="{{ route('login') }}" class="link">Back to Log in</a>
        </p>
    </form>
</div>
@endsection