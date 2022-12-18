<header class="header">
  <nav class="navbar">
    <div class="navbar-content">
      <ul class="navbar-list">
        <li class="navbar-item">
          <a class="navbar-link" href="{{ route('/') }}">Home</a></li>
        <li class="navbar-item">
          <a class="navbar-link" href="{{ route('pages.category') }}">Producten</a>
        </li>
        <li class="navbar-item">
          <a class="navbar-link" href="{{ route('pages.discount') }}">Aanbiedingen</a></li>
        <li class="navbar-item">
          <a class="navbar-link" href="{{ route('cart.index') }}">Winkelwagen</a>
            @if(Cart::session('_token')->getTotalQuantity() > 0)
              <span class="cart-count">{{ Cart::session('_token')->getTotalQuantity() }}</span>
            @endif
        </li>
        <li class="navbar-item">
          <a class="navbar-link" href="{{ route('cart.orders') }}">Bestellingen</a></li>
      </ul>
      {{-- geautoriseerde gebruiker --}}
      @if (auth()->check())
        <div class="navbar-account" x-data="{ show:false }">
          <button class="navbar-link auth-user"  @click="show=!show">{{ auth()->user()->name }}</button>
          <div class="lyout-menu" x-show="show">
            <form method="POST" action="/logout">
              @csrf
              <ul class="lyout-menu-list">
                <li class="lyout-menu-item"><button class="navbar-link" type="submit">Log Out</button></li>
              </ul>
            </form>
          </div>
        </div>
      {{-- de gast --}}
      @else
        <div class="navbar-account" x-data="{ show:false }" >
          <button class="navbar-link" @click="show=!show" >Account</button>
          <div class="lyout-menu" x-show="show" >
            <ul class="lyout-menu-list">
              <li class="lyout-menu-item"><a class="navbar-link" href="/register">Registratie</a></li>
              <li class="lyout-menu-item"><a class="navbar-link" href="/login">Login</a></li>
            </ul>
          </div>
        </div>
      @endif
    </div>
  </nav>
</header>