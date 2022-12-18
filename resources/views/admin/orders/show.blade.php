@extends('admin.layouts.layout')
@section('admincontent')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Order №{{ $order->id }}</h4>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr class="text-xs">
                <th style="width: 30px">#</th>
                <th>Product</th>
                <th>Aantal</th>
                <th>Prijs per stuk</th>
                <th>Prijs</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($order->cart_data as $cart)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $cart->name }}</td>
                <td>{{ $cart->quantity }}</td>
                <td>{{ $cart->price }}</td>
                <td>{{ $cart->price*$cart->quantity }}</td>
              </tr>
              @endforeach
              <tr>
                <td colspan="2">Subtotaal</td>
                <td colspan="2">{{ $order->totalQuantity }}</td>
                <td colspan="1">{{ $order->subTotal }}</td>
              </tr>
              <tr>
                <td colspan="4">Verzendkosten</td>
                <td colspan="1">{{ $order->shipping_cost }}</td>
              </tr>
              <tr>
                <td colspan="4">Totaal incl. verzending</td>
                <td colspan="1">{{ $order->subTotal + $order->shipping_cost }}</td>
              </tr>
            </tbody>
          </table>
          <div class="col-md-12">
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->

@endsection