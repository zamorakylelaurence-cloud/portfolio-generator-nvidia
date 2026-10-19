
@extends('layouts.app')

@section('title', 'Log In')

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <p class="auth-eyebrow">MYPORTFOLIO</p>
        <h1>Welcome back</h1>
        <p class="auth-description">Log in to manage your portfolios.</p>

        @if ($errors->any())
            <div class="auth-errors">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        
<form method="POST" action="{{ route('login.store') }}">
    @csrf

    <label for="email">Email address</label>
    <input
        id="email"
        name="email"
        type="email"
        value="{{ old('email') }}"
        autocomplete="email"
        required
    >

    <label for="password">Password</label>
    <input
        id="password"
        name="password"
        type="password"
        autocomplete="current-password"
        required
    >

    <label>
        <input type="checkbox" name="remember" value="1">
        Remember me
    </label>

    @if ($errors->any())
        <div class="auth-errors">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <button type="submit" class="auth-button">Log In</button>
</form>

<p class="auth-switch">
    Don't have an account?
    <a href="{{ route('register') }}">Sign up</a>
</p>

    </div>
</div>
@endsection
