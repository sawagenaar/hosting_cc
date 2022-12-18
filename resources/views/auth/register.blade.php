@extends('master_home')

@section('content')
<div class="login-form">

    <form method="POST" action="{{ route('register') }}">
        @csrf
        {{-- Name --}}
        <div class="login-item">
            <label for="name" class="login-label">{{ __('Name') }}</label>
            <input id="name" type="text" class="login-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="error-message" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <!-- E-mail -->
        <div class="login-item">
            <label for="email" class="login-label">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="login-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="error-message" role="alert">{{ $message }}</span>
            @enderror
        </div>

        {{-- Password --}}
        <div class="login-item">
            <label for="password" class="login-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="login-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="error-message" role="alert">{{ $message }}</span>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="login-item">
            <label for="password-confirm" class="login-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="login-input" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="login-btn">
            <button type="submit" class="add log-in">{{ __('Register') }}</button>
        </div>
    </form>
</div>
@endsection
