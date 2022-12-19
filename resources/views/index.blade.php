{{-- Startpagina van de site --}}
@extends('master_home')

@section('content')
<div class="container">
  {{-- Promotie beschrijving --}}
  @if ($sale)
    <div class="description offer-description">
      <h2 class="title">{{ $sale->title }}</h2>
      <h3 class="subtitle">{{ $sale->shortdescription }}</h3>
      <h3 class="subtitle">{{ $sale->fulldescription }}</h3>
      <a class="link" href="#">Lees verder</a>
    </div>
    <div class="photo">
      <img class="photo-exl" src="{{ asset('storage/'.$sale->image) }}">
    </div>
  @else
    <div class="cart-message">Geen aanbieding</div>
  @endif
</div>
{{-- Afgeprijsde producten --}}
<div class="container">
  @if (count($discounts))
    <ul class="sales-list">
      @foreach($discounts as $discount)
      <li class="sales-item">
        <div class="sale-description"><a class="link" href="{{ route('pages.product', $discount->slug) }}">
          <h2 class="title">{{ $discount->name }}</h2>
          <p class="info">{{ $discount->shortdescription }}</p>
          <p class="info">{{ $discount->fulldescription }}</p>
          </a>
        </div>
        <div class="product-item">
          <div class="item">
            <img class="photo-md" src="{{ asset('storage/'.$discount->image) }}">
          </div>
          <div class="price-block">
            <del class="price subcategory-price">{{ number_format($discount->price, 2, '.', '') }}</del>
            <span class="price-discount subcategory-price">{{ number_format($discount->discounted_price, 2, '.', '') }}</span>
          </div>
        </div>
      </li>
      @endforeach
    </ul>
  @else
    <div class="cart-message">Geen discounts</div>
  @endif
</div>
{{-- News --}}
<div class="container news-container">
  @if ($news)
    <div class="description news-description">
      <h2 class="title">{{ $news->title }}</h2>
      <p class="info">{{ $news->shortdescription }}</p>
      <a class="link" href="#">Lees verder</a>
    </div>
    <div class="photo">
      <img class="photo-exl" src="{{ asset('storage/'.$news->image) }}" width="11em">
    </div>
  @else
    <div class="cart-message">Geen news</div>
  @endif
</div>
@endsection