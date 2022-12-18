@extends('master_home')

@section('content')
{{-- Productcategorieën --}}
<main class="category-content">
  <ul class="category-list">
    @foreach ($categories as $category)
    <li class="category-list-item">
      <div class="product-item">
        <div class="category-item">
          <img class="photo-lg" src="{{ asset('storage/'.$category->image) }}">
        </div>
        <a class="category-link link" href="{{ route('pages.subcategory', ['slug'=>$category->slug]) }}">
          {{ $category->name }}</a>
      </div>
    </li>
    @endforeach
  </ul>
</main>

@endsection
