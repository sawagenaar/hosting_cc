@extends('admin.layouts.layout')
@section('admincontent')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Orders lijst</h4>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-body">
        @if (count($orders))
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr class="text-xs">
                  <th style="width: 30px">#</th>
                  <th style="width: 30px">User id</th>
                  <th>Email</th>
                  <th>User name</th>
                  <th>Adres</th>
                  <th>Telefoon</th>
                  <th>Bezorgtijd</th>
                  <th>Sub<br>totaal</th>
                  <th>Verzend<br>kosten</th>
                  <th>Totaal</th>
                  <th>Status</th>
                  <th>Bestelling gemaakt</th>
                  <th>Bestelling bijgewerkt</th>
                  <th style="width: 30px">Actions</th>
                </tr>
              </thead>
              <tbody class="text-xs">
                @foreach ($orders as $order)
                <tr>
                  <td>{{ $order->id }}</td>
                  <td>{{ $order->user_id }}</td>
                  <td>{{ $order->email}}</td>
                  <td>{{ $order->name.'  '.$order->surname }}</td>
                  <td>{{ $order->address }}</td>
                  <td>{{ $order->phone }}</td>
                  <td>{{ $order->day.': '.$order->partday }}</td>
                  <td>{{ $order->subTotal }}</td>
                  <td>{{ $order->shipping_cost }}</td>
                  <td>{{ $order->subTotal + $order->shipping_cost }}</td>
                  <td>{{ $order->status }}</td>
                  <td>{{ $order->created_at }}</td>
                  <td>{{ $order->updated_at }}</td>
                  <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-success btn-xs float-left mr-1">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-info btn-xs float-left mr-1 mt-1">
                      <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="post" class="float-left mt-1">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-xs">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="col-md-12">
              <div class="pagination pagination-sm m-0 float-right">
                {{ $orders->links() }}
              </div>
            </div>
          </div>
        @else
          <p>Geen orders</p>
        @endif
    </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->

@endsection