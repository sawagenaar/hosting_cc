@extends('master_home')
@section('search')
  <nav class="navbar">
    <p class="title title-pages">Bestelling</p>
  </nav>
@stop
@section('content')
@section('content')
<div class="form-order">
  {{-- @foreach ($orders as $order) --}}
  {{-- {{dd($order)}} --}}
  <table class="form-table">
    <caption class="form-titel">Besteling № {{ $order->id }}</caption>
    <thead>
      <tr>
        <th style="width: 20px">#</th>
        <th class="form-cell">Product</th>
        <th>Aantal</th>
        <th>Prijs per stuk</th>
        <th>Prijs</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($order->cart_data as $cart)
      {{-- {{ dd($order->cart_data) }} --}}
      <tr class="table-row">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $cart->name }}</td>
        <td>{{ $cart->quantity }}</td>
        <td>{{ $cart->price }}</td>
        <td>{{ $cart->price*$cart->quantity }}</td>
      </tr>
      @endforeach
      <tr class="table-row">
        <td>Total</td>
        <td></td>
        <td>{{ $order->totalQuantity }}</td>
        <td></td>
        <td>{{ $order->subTotal }}</td>
      </tr>
      <tr class="table-row">
        <td>Verzendkosten</td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{ $order->shipping_cost }}</td>
      </tr>
      <tr class="table-row">
        <td>Totaal incl. verzending</td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{ $order->subTotal + $order->shipping_cost }}</td>
      </tr>
    </tbody>
  </table>
  {{-- @endforeach --}}
</div>
@endsection