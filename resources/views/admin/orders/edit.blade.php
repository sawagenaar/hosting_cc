@extends('admin.layouts.layout')

@section('admincontent')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Order bewerken</h4>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            {{-- form> --}}
            <form role="form" method="post" action="{{ route('admin.orders.update', $order->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid" @enderror id="email" value="{{ $order->email }}">
                  </div>
                  <div class="form-group">
                    <label for="name">Naam</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid" @enderror id="name" value="{{ $order->name }}">
                  </div>
                  <div class="form-group">
                    <label for="surname">Achternaam</label>
                    <input type="text" name="surname" class="form-control @error('surname') is-invalid" @enderror id="surname" value="{{ $order->surname }}">
                  </div>
                  <div class="form-group">
                    <label for="address">Adres</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid" @enderror id="address" value="{{ $order->address }}">
                  </div>
                  <div class="form-group">
                    <label for="phone">Telefoon</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid" @enderror id="phone" value="{{ $order->phone }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="day">Bezorgdag</label>
                    <input type="text" name="day" class="form-control @error('day') is-invalid" @enderror id="day" value="{{ $order->day }}">
                  </div>
                  <div class="form-group">
                    <label for="partday">Bezorgtijd</label>
                    <input type="text" name="partday" class="form-control @error('partday') is-invalid" @enderror id="partday" value="{{ $order->partday }}">
                  </div>
                  <div class="form-group">
                    <label for="subTotal">Subtotaal</label>
                    <input type="text" name="subTotal" class="form-control @error('subTotal') is-invalid" @enderror id="subTotal" value="{{ $order->subTotal }}">
                  </div>
                  <div class="form-group">
                    <label for="shipping_cost">Verzendkosten</label>
                    <input type="text" name="shipping_cost" class="form-control @error('shipping_cost') is-invalid" @enderror id="shipping_cost" value="{{ $order->shipping_cost }}">
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" name="status" class="form-control @error('status') is-invalid" @enderror id="status" value="{{ $order->status }}">
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection