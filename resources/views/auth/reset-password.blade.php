@extends('layouts.app')

@section('content')
<div class="auth-card">
    <div class="auth-logo">
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Expensir') }} Logo" class="app-logo">
        </a>
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

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">New Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="btn btn-primary btn-block">
               Reset Password
            </button>
        </div>
    </form>
</div>
@endsection