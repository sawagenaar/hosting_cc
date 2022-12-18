@extends('master_home')
@section('search')
  <nav class="navbar">
    <p class="title title-pages">Bestelling</p>
  </nav>
@stop
@section('content')
  <div class="navbar-order">
    <div class="order-stap">Stap 1: Kies uw bezorgmoment</div>
    <div class="order-stap order-stap-active">Stap 2: Doe uw boodschappen</div>
    <i class="fa-solid fa-chevron-right"></i>
    <div class="order-stap">Stap 3: Bevestig uw bestelling</div>
  </div>
<!-- content -->
<div class="delivery-content">
  <form method="post" action="{{ route('cart.make', $user->id) }}">
    @csrf
    <div>
      <div class="nav-day">
        <input class="form-radio" type="radio" id="maandag" name="day" value="maandag" checked >
        <label class="week-day" for="maandag">Mandaag</label>

        <input class="form-radio" type="radio" id="dinsdag" name="day" value="dinsdag">
        <label class="week-day" for="dinsdag">Dinsdag</label>

        <input class="form-radio" type="radio" id="woensdag" name="day" value="woensdag">
        <label class="week-day" for="woensdag">Woensdag</label>

        <input class="form-radio" type="radio" id="donderdag" name="day" value="donderdag">
        <label class="week-day" for="donderdag">Donderdag</label>

        <input class="form-radio" type="radio" id="vrijdag" name="day" value="vrijdag">
        <label class="week-day" for="vrijdag">Vrijdag</label>

        <input class="form-radio" type="radio" id="zaterdag" name="day" value="zaterdag">
        <label class="week-day" for="zaterdag">Zaterdag</label>

        <input class="form-radio" type="radio" id="zondag" name="day" value="zondag">
        <label class="week-day" for="zondag">Zondag</label>
      </div>
    </div>
    <div class="delivery">
      <div class="delivery-title">Bezorgmomenten</div>
      <input class="form-radio" type="radio" id="part1" name="partday" value="08:00-22:00" checked >
      <label class="delivery-item" for="part1">
        <span class="delivery-time">08:00-22:00</span>
        <span class="delivery-price">&#x20AC 4,95</span>
        <button class="add delivery-btn" type="button" name="button">Kies</button>
      </label>
      <input class="form-radio" type="radio" id="part2" name="partday" value="16:00-22:00">
      <label class="delivery-item" for="part2">
        <span class="delivery-time">16:00-22:00</span>
        <span class="delivery-price">&#x20AC 6,95</span>
        <button class="add delivery-btn" type="button" name="button">Kies</button>
      </label>
      <input class="form-radio" type="radio" id="part3" name="partday" value="19:00-21:00">
      <label class="delivery-item" for="part3">
        <span class="delivery-time">19:00-21:00</span>
        <span class="delivery-price">&#x20AC 7,50</span>
        <button class="add delivery-btn" type="button" name="button">Kies</button>
      </label>
      <input class="form-radio" type="radio" id="part4" name="partday" value="20:00-22:00">
      <label class="delivery-item" for="part4">
        <span class="delivery-time">20:00-22:00</span>
        <span class="delivery-price">&#x20AC 7,50</span>
        <button class="add delivery-btn" type="button" name="button">Kies</button>
      </label>
    </div>

    <div class="delivery-address">
      <div class="address-container">
        <p class="address-title">Uw boodschappen worden bezorgd op dit adres</p>
        <div class="address-data">{{ $delivery->address }}</div>
      </div>
      <div class="address-change form-button">
        <button type="button"class="address-btn form-btn"> <a class="form-address" href="{{ route('cart.profile') }}">Bezorgadres wijzigen</a></button>
        <button type="submit" class="address-btn form-btn">Verder</button>
      </div>
    </div>
  </form>
</div>
@endsection