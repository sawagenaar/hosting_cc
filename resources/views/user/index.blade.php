{{-- De pagina waar de geautoriseerde gebruiker terechtkomt --}}

@extends('master_home')
@section('content')
<div class="wrapper-content">
    <p class="cart-message">Welcom, {{ auth()->user()->name }}</p>
    <p class="cart-message">Persoonlijk account van een vaste klant</p>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="address-btn">Log Out</button>
    </form>
</div>
@endsection
