@extends('layouts.app')

@section('content')
<div class="auth-card">
     <div class="auth-logo">
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Expensir') }} Logo" class="app-logo">
        </a>
    </div>

    <div class="mb-4 text-sm" style="color: var(--color-text-secondary);">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 alert alert-success" role="alert">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <button type="submit" class="btn btn-primary">
                    Resend Verification Email
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
             <button type="submit" class="link" style="font-size: 0.9rem;">
                Log Out
            </button>
        </form>
    </div>
</div>
@endsection