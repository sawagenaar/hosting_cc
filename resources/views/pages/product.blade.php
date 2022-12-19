@extends('master_home')

@section('content')
{{-- Сategorie naam --}}
<div class="product-title">
  @foreach ($categories as $category)
  <a class="title link product-title-link" href="{{ route('pages.category') }}">{{ $category->name }}</a>
  <div class="photo">
    <img class="photo-md" src="{{ asset('storage/'.$category->image) }}">
  </div>
  @endforeach
</div>
<div class="product">
  <div class="product-photo">
    <img class="photo-exxl" src="{{ asset('storage/'.$product->image) }}">
  </div>
  <div class="product-description">
    <h2 class="subtitle">{{ $product->name }}</h2>
      @if($product->discount > 0)
        <del class="price">{{ number_format($product->price, 2, '.', '') }}</del>
        <span class="price-discount">{{ number_format($product->discounted_price, 2, '.', '') }}</span>
      @else
        <span class="price">{{ number_format($product->price, 2, '.', '') }}</span>
      @endif
    <p class="description-short">Korte omschrijvingstekst</p>
    <p class="description-text">{{ $product->shortdescription }}</p>
  </div>
  <div class="btn-block">
      <form action="{{ route('cart', $product->slug) }}" method="POST">
        @csrf
        <label for="label-quantity"></label>
        <input type="text" name="qty" id="input-quantity" value="1" class="input-quantity">
        <button type="submit" class="add">Voeg toe</button>
      </form>
  </div>
</div>

<div class="description-full">
Productomscrijving
</div>
<div class="description-full">
  <p>{{ $product->fulldescription }}</p>
</div>

@endsection
