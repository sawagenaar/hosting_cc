@extends('master_home')
@section('search')
  <nav class="navbar">
    <p class="title title-pages">Bestellen</p>
  </nav>
@stop
@section('content')
  <div class="navbar-order">
    <div class="order-stap order-stap-active">Stap 1: Vul je verzendinformatie</div>
    <i class="fa-solid fa-chevron-right"></i>
    <div class="order-stap">Stap 2: Kies uw bezorgmoment</div>
    <i class="fa-solid fa-chevron-right"></i>
    <div class="order-stap">Stap 3: Bevestig uw bestelling</div>
  </div>
{{-- content --}}
<div>
  <form method="post" action="{{ route('cart.delivery') }}"  class="form-content">
    @csrf
    <div class="personal-info">
      <h2 class="form-titel-info">Verzendinformatie</h2>
      <div class="form-item">
        <label for="form-name" class="form-label">Naam</label>
        <input id="form-name" type="text" class="form-input" name="name" value="{{ $user->name }}" required  autofocus>
      </div>
      <div class="form-item">
        <label for="form-surname" class="form-label">Achternaam</label>
        <input id="form-surname" type="text" class="form-input" name="surname"  required  autofocus>
      </div>
      <div class="form-item">
        <label for="form-email" class="form-label">Email</label>
        <input id="form-email" type="email" class="form-input" name="email" value="{{ $user->email }}" required  autofocus>
      </div>
      <div class="form-item">
        <label for="form-phone" class="form-label">Telefoon</label>
        <input id="form-phone" type="phone" class="form-input" name="phone" required  autofocus>
      </div>
      <div class="form-item">
        <label for="form-address" class="form-label">Adres</label>
        <input id="form-address" type="text" class="form-input" name="address"  required  autofocus>
      </div>
    </div>
    <div class="form-order">
      <table class="form-table">
        <caption class="form-titel">Besteling informatie</caption>
        <thead>
          <tr>
            <th style="width: 20px">#</th>
            <th class="form-cell">Product</th>
            <th>Aantal</th>
            <th>Prijs</th>
          </tr>
        </thead>
        <tbody>
          @foreach (Cart::getContent()->sortBy('name') as $item)
          <tr class="table-row">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price*$item->quantity }}</td>
          </tr>
          @endforeach
          <tr class="table-row">
            <td>Totaal</td>
            <td></td>
            <td>{{ $cartTotalQuantity }}</td>
            <td>{{ $subTotal }}</td>
          </tr>
        </tbody>
      </table>
      <div class="form-button">
        <button type="button"class="address-btn form-btn"> <a class="form-address" href="{{ route('cart.index') }}">Terug</a></button>
        <button type="submit" class="address-btn form-btn">Verder</button>
      </div>
    </div>
  </form>
</div>

@endsection