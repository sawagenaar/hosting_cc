@extends('master_home')

@section('content')

<main class="category-content">
  <ul class="category-list">
    @if(count($search))
      @foreach ($search as $item)
        <li class="subcategory-list-item">
          <div class="subcategory-item">
            <div class="sub-item">
              <img class="photo-md" src="{{ asset('storage/'.$item->image) }}">
            </div>
            <div class="price-block">
              @if($item->discount > 0)
                <del class="price subcategory-price">{{ number_format($item->price, 2, '.', '') }}</del>
                <span class="price-discount subcategory-price">{{ number_format($item->discounted_price, 2, '.', '') }}</span>
              @else
                <span class="price subcategory-price">{{ number_format($item->price, 2, '.', '') }}</span>
              @endif
            </div>
          </div>
          <div class="subcategory-description">
            <div><a class="link" href="{{ route('pages.product', ['slug'=>$item->slug]) }}">{{ $item->name }}<br>{{ $item->shortdescription }}</a></div>
          </div>
        </li>
      @endforeach

  </ul>
  @else
    <div class="cart-message message">We hebben niets gevonden. Probeer een andere omschrijving.</div>
  @endif
</main>

@endsection