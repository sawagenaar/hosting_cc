<nav class="navbar">
  <form method="GET" action="{{ route('pages.search') }}">
    <input class="search" type="text" name="search" placeholder="Zoek een product">
    <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass fa-rotate-90"></i></button>
  </form>
</nav>