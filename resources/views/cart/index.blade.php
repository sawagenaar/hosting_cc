@extends('master_home')

@section('content')
@if ($items->count() > 0)
<div class="cart-content">
  <div class="cart-add">
    <a class="add" href="{{ route('cart.profile') }}">Bestellen</a>
    <h2 class="title">{{ $cartTotalQuantity }} items in Shopping Cart</h2>
    <div class="sort">
      <span class="sort-name">Sorteer op: </span>
      <form method="GET" action="{{route('cart.index')}}" class="sort">
        @csrf

        <select class="sort-menu" name="sort">
          <option value="" disabled selected>Select your option</option>
          <option value="price">Price</option>
          <option value="name">Name</option>
        </select>
        <button type="submit" class="btn"><i class="fa-solid fa-chevron-right fa-2x"></i></button>
      </form>
    </div>
  </div>
    <div class="cart">
      <ul class="cart-list">
        @foreach (Cart::getContent()->sortBy($sort) as $item)
        <li class="cart-item">
          <div class="cart-item-name">
            <div class="cart-photo">
              <img class="photo-xs" src="{{ asset('storage/'.$item->associatedModel->image) }}">
            </div>
            <div class="cart-description">
              <a class="cart-naam link" href="{{ route('pages.product', $item->associatedModel->slug) }}">{{ $item->name }}</a>
            </div>
          </div>
          <div class="cart-item-action">
            <div class="delete">
              <form action="{{ route('cart.remove', $item->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                  <i class="fa-solid fa-trash-can fa-xl"></i>
                </button>
              </form>
            </div>
            <div>
              <span class="basket-price"></span>
            </div>
            <div class="quantity">
              <form action="{{ route('cart.minus', $item->id) }}"method="post">
                @csrf
                <button class="minus-btn" type="submit">
                  <i class="fa-solid fa-minus"></i>
                </button>
              </form>
              <span class="count">{{ $item->quantity }}</span>
              <form action="{{ route('cart.plus', $item->id) }}" method="post">
                @csrf
                <button class="plus-btn" type="submit">
                  <i class="fa-solid fa-plus"></i>
                </button>
              </form>
            </div>
            <div>
              <span class="basket-price">{{ number_format( $item->price*$item->quantity, 2, '.', '') }}</span>
            </div>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
  <div class="cart-add">
    <span>Total</span>
    <span class="basket-price-total">{{ $subTotal }}</span>
  </div>
  <div class="cart-add">
    <a class="add" href="{{ route('cart.profile') }}">Bestellen</a>
  </div>
</div>
@else
  <div class="cart-message">Jouw mandje is leeg</div>
  <i class="fa-solid fa-cart-shopping fa-7x"></i>
@endif
@endsection