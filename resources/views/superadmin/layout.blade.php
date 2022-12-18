<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/awesome/css/all.min.css') }}">
  <!-- Theme style -->

  <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('/') }}" class="nav-link">Home page</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
            <form method="POST" action="/logout">
              @csrf
                <button class="btn btn-sm btn-link ml-5 p-0" type="submit">Log Out</button>
            </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <span class="brand-text font-weight-light">Adminpanel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.index')}}" class="nav-link">
              <i class="nav-icon fas fa-home-alt"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('admin.index')}}" class="nav-link">
              <i class="nav-icon fa-regular fa-file-lines"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('superadmin.admin.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users lijst</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('admin.index')}}" class="nav-link">
              <i class="nav-icon fa-regular fa-file-lines"></i>
              <p>
                Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders lijst</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('admin.index')}}" class="nav-link">
              <i class="nav-icon fa-solid fa-layer-group"></i>
              <p>
                Categories
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Сategorie lijst</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.categories.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create categorie</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('admin.index')}}" class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Subcategories
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.subcategories.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subcategorie lijst</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.subcategories.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create subcategorie</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('admin.index')}}" class="nav-link">
              <i class="nav-icon fa-solid fa-boxes-stacked"></i>
              <p>
                Producten
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Producten lijst</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.products.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create product</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('admin.index')}}" class="nav-link">
              <i class="nav-icon fa-solid fa-newspaper"></i>
              <p>
                News
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.news.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nieuwsberichten</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.news.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create nieuwsbericht</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('admin.index')}}" class="nav-link">
              <i class="nav-icon fa-solid fa-percent"></i>
              <p>
                Aanbiedingen
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.discounts.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aanbiedingen lijst</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.discounts.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create aanbieding</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper mt-2">
    <div class="container">
      <div class="row">
        <div class="col-12">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          @if (session()->has('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        </div>
      </div>
    </div>
  <!-- Content Wrapper. Contains page content -->
  @yield('admincontent')
  <!-- /.content-wrapper -->
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset ('assets/admin/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset ('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('assets/admin/js/adminlte.min.js') }}"></script>
</body>
</html>
