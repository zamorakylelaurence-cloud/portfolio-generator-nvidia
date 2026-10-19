
@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <p class="auth-eyebrow">MYPORTFOLIO</p>
        <h1>Create your account</h1>
        <p class="auth-description">Build and manage your professional portfolio.</p>

        @if ($errors->any())
            <div class="auth-errors">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <label for="name">Full name</label>
            <input id="name" name="name" type="text"
                   value="{{ old('name') }}" required autocomplete="name">

            <label for="email">Email address</label>
            <input id="email" name="email" type="email"
                   value="{{ old('email') }}" required autocomplete="email">

            <label for="password">Password</label>
            <input id="password" name="password" type="password"
                   required autocomplete="new-password">

            <label for="password_confirmation">Confirm password</label>
            <input id="password_confirmation" name="password_confirmation"
                   type="password" required autocomplete="new-password">

            <button type="submit" class="auth-button">Create Account</button>
        </form>

        <p class="auth-switch">
            Already have an account?
            <a href="{{ route('login') }}">Log in</a>
        </p>
    </div>
</div>
@endsection
