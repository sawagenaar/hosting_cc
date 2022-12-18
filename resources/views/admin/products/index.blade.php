@extends('admin.layouts.layout')

@section('admincontent')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Producten lijst</h4>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-body">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Add product</a>
        @if (count($products))
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr class="text-xs">
                  <th style="width: 30px">#</th>
                  <th>Product naam</th>
                  <th>Slug</th>
                  <th>Korte beschrijving</th>
                  <th>Volledige beschrijving</th>
                  <th>Discount</th>
                  <th>Prijs</th>
                  <th>Gewicht</th>
                  <th>Image</th>
                  <th style="width: 30px">Sub<br>category slug </th>
                  <th style="width: 30px">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                <tr class="text-sm">
                {{-- role='button' onclick="window.location.href='{{ route('admin.products.show', $product->slug) }}'; return false"> --}}
                  <td>{{ $product->id }}</td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->slug }}</td>
                  <td>{{ $product->shortdescription }}</td>
                  <td>{{ $product->fulldescription }}</td>
                  <td>{{ $product->discount }}</td>
                  <td>{{ $product->price }}</td>
                  <td>{{ $product->weight }}</td>
                  <td>
                    <img src="{{ asset('storage/'.$product->image) }}" width="50px">
                  </td>
                  <td>{{ $product->sub_category_slug }}</td>
                  <td>
                    <a href="{{ route('admin.products.edit', $product->slug) }}" class="btn btn-info btn-sm float-left mr-1">
                      <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('admin.products.destroy', $product->slug) }}" method="post" class="float-left">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm mt-2">
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
                {{ $products->links() }}
              </div>
            </div>
          </div>
        @else
          <p>Geen producten</p>
        @endif
    </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        </div>
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->

@endsection