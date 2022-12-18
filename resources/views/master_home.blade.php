{{-- Layout van de website. Lettertypen, pictogrammen en stijlen koppelen hier.
Een layout bestaat uit components en content van de site. --}}

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/awesome/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Commodium Copia</title>
  </head>
  <body>
    <div id="app">
      <div class="wrapper">
        @include('components.header')
        @section('search')
          @include('components.search')
        @show
        <div class="wrapper-content">
          @include('components.flash')
          @yield('content')
        </div>
        @include('components.footer')
      </div>
    </div>
    <script src="{{ asset ('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  </body>
</html>