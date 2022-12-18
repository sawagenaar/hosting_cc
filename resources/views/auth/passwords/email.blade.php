@extends('master_home')

@section('content')
<div class="wrapper-content">
<div class="login-form">
    <div class="login-item-description">Je wachtwoord vergeten?</div>
    <div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    </div>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="login-item">
            <label for="email" class="login-label">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="login-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="error-message" role="alert">{{ $message }}<span>
            @enderror
        </div>
        <div class="login-btn">
            <button type="submit" class="add log-in">
                {{ __('Wachtwoord rezet') }}
            </button>
        </div>
    </form>
</div>
</div>
@endsection
