@extends('layouts.app')

@section('content')
    <div class="content-header">
         <h2 class="content-title">Profile Management</h2>
    </div>

    <div class="profile-container">
        {{-- Update Profile Information --}}
        <div class="card form-card mb-4">
            <h3 class="form-card-title">Profile Information</h3>
            <p class="form-card-subtitle">Update your account's profile information and email address.</p>
             @include('profile.partials.update-profile-information-form')
        </div>

        {{-- Update Password --}}
        <div class="card form-card mb-4">
            <h3 class="form-card-title">Update Password</h3>
            <p class="form-card-subtitle">Ensure your account is using a long, random password to stay secure.</p>
             @include('profile.partials.update-password-form')
        </div>

         {{-- Delete Account (Optional) --}}
        {{-- Consider UX implications carefully before enabling permanent deletion --}}
        <div class="card form-card card-danger">
            <h3 class="form-card-title">Delete Account</h3>
            <p class="form-card-subtitle">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
             @include('profile.partials.delete-user-form')
        </div>
    </div>

    {{-- Add Specific Profile CSS --}}
    <style>
        .profile-container .card { margin-bottom: 2rem; }
        .form-card-title { font-size: 1.2rem; font-weight: 600; color: var(--color-primary); margin-bottom: 0.5rem;}
        .form-card-subtitle { font-size: 0.9rem; color: var(--color-text-secondary); margin-bottom: 2rem;}
        .profile-container form { margin-top: 1rem;}
        .profile-container .form-actions { margin-top: 1.5rem; padding-top: 1rem; border-top: none; justify-content: flex-start; }
        .profile-container .card-danger { border-left: 4px solid #555; } /* Or a subtle red */
        .profile-container .btn-danger { background-color: #333; color: white; border-color: #333;} /* Dark delete button */
        .profile-container .btn-danger:hover { background-color: #000; border-color: #000; }
        .status-message { font-size: 0.9rem; color: var(--color-primary); font-weight: 500; margin-left: 1rem; animation: fadeIn 0.5s ease;}
    </style>

@endsection