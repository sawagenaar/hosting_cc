@extends('master_home')

@section('content')
<div class="login-form">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        {{-- Email --}}
        <div class="login-item">
            <label for="email" class="login-label">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="login-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="error-message" role="alert">{{ $message }}</span>
            @enderror
        </div>
        {{-- Password --}}
        <div class="login-item">
            <label for="password" class="login-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="login-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="error-message" role="alert">{{ $message }}</span>
            @enderror
        </div>
        {{-- Remember me --}}
        <div class="login-item">
            <div class="remember">
                <input class="remember-me" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="login-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>

        <div class="login-btn">
            <a class="add log-in log-btn" href="{{ route('register') }}">
                Hebt u geen account?  {{ __('Nu registreren') }}</a>
            <button type="submit" class="add log-in">{{ __('Login') }} </button>
        </div>
    </form>
</div>
@endsection
