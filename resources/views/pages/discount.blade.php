@extends('master_home')
{{-- Afgeprijsde producten --}}
@section('content')
<div class="container category-container">
  <div class="description news-description">
    <p class="title">Aanbieding</p>
  </div>
</div>
<div class="category-content">
  <ul class="subcategory-list">
    @foreach($discounts as $discount)
      <li class="subcategory-list-item">
        <div class="subcategory-item">
          <div class="sub-item">
            <img class="photo-md" src="{{ asset('storage/'.$discount->image) }}">
          </div>
          <div class="price-block">
            <del class="price subcategory-price">{{ number_format($discount->price, 2, '.', '') }}</del>
            <span class="price-discount subcategory-price">{{ number_format($discount->discounted_price, 2, '.', '') }}</span>
          </div>
        </div>
        <div class="subcategory-description">
          <div><a class="link" href="{{ route('pages.product', ['slug'=>$discount->slug]) }}">{{ $discount->name }}<br>{{ $discount->shortdescription }}</a></div>
        </div>
      </li>
    @endforeach
  </ul>
</div>

@endsection