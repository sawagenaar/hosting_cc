@extends('master_home')
@section('search')
  <nav class="navbar">
    <p class="title title-pages">Bestellen</p>
  </nav>
@stop
@section('content')

<div class="order-active">
  <div class="order-title title">Openstaande bestellingen</div>
  <ul class="order-list">
    @foreach($orders as $order)
      @if($order->status == 0)
      <li class="order-item-container">
        <div class="order-item-active">
          <div class="icon-photo">
            <i class="fa-solid fa-clock fa-2x"></i>
          </div>
          <div class="order-description">
            <div class="order-info"> {{ $order->day }}, {{ $order->partday }}, {{ $order->address }}</div>
            <a class="link" href="{{ route('cart.order', $order->id) }}">Bestelde producten</a>
          </div>
        </div>
        @if($order->status == 0)
          <div class="order-status">Wachtend</div>
        @endif
      </li>
      @endif
    @endforeach
  </ul>
</div>
<div class="order-past">
  <div class="order-title title">Eerdere bestellingen</div>
  <ul class="order-list">
    @foreach($orders as $order)
      @if($order->status == 1)
        <li class="order-item-container">
          <div class="order-item-active">
            <div class="icon-photo">
              <i class="fa-solid fa-cart-shopping fa-2x"></i>
            </div>
            <div class="order-description">
              <div class="order-info">{{ $order->day }}, {{ $order->partday }}, {{ $order->address }}</div>
              <a class="link" href="{{ route('cart.order', $order->id) }}">Bestelde producten</a>
            </div>
          </div>
          @if($order->status == 1)
            <div class="order-status">Voltooid</div>
          @endif
        </li>
      @endif
    @endforeach
  </ul>
</div>
@endsection