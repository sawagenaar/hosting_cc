@extends('master_home')

@section('content')
<div class="container category-container">
  <div class="description news-description">
    <a class="title link" href="{{ route('pages.category') }}">{{ $category->name }}</a>
  </div>
  <div class="photo">
    <i class="fas fa-camera-retro fa-3x"></i>
  </div>
</div>

<div class="category-content">
  @foreach ($subcategories as $subcategory)
  <ul class="subcategory-list">
    <div class="subcategory-name">{{ $subcategory->name}}</div>

    @foreach ($subcategory->products_rel as $product)

    <li class="subcategory-list-item">
      <div class="subcategory-item">
        <div class="sub-item">
          <img class="photo-sm" src="{{ asset('storage/'.$product->image) }}">
          {{-- <i class="fas fa-camera-retro fa-2x"></i> --}}
        </div>
        <div class="price-block">
          @if($product->discount > 0)
            <del class="price subcategory-price">{{ number_format($product->price, 2, '.', '') }}</del>
            <span class="price-discount subcategory-price">{{ number_format($product->discounted_price, 2, '.', '') }}</span>
          @else
            <span class="price subcategory-price">{{ number_format($product->price, 2, '.', '') }}</span>
          @endif
        </div>
      </div>
      <div class="subcategory-description">
        <div><a class="link" href="{{ route('pages.product', ['slug'=>$product->slug]) }}">{{ $product->name }}<br>{{ $product->shortdescription }}</a></div>
      </div>
    </li>
    @endforeach
  </ul>
  @endforeach
</div>

@endsection