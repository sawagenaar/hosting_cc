@extends('admin.layouts.layout')

@section('admincontent')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Aanbiedingen lijst</h4>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-body">
        <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary mb-3">Add aanbieding</a>
        @if (count($discounts))
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr class="text-xs">
                  <th style="width: 30px">#</th>
                  <th>Aanbieding naam</th>
                  <th>Image</th>
                  <th>Korte beschrijving</th>
                  <th>Volledige beschrijving</th>
                  <th>Start datum</th>
                  <th>End datum</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($discounts as $discount)
                <tr class="text-sm">
                  <td>{{ $discount->id }}</td>
                  <td>{{ $discount->title }}</td>
                  <td>
                    <img src="{{ asset('storage/'.$discount->image) }}" width="100px">
                  </td>
                  <td>{{ $discount->shortdescription }}</td>
                  <td>{{ $discount->fulldescription }}</td>
                  <td>{{ $discount->startTime }}</td>
                  <td>{{ $discount->endTime }}</td>
                  <td>
                    <a href="{{ route('admin.discounts.edit', $discount->id) }}" class="btn btn-info btn-sm float-left mr-1">
                      <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('admin.discounts.destroy', $discount->id) }}" method="post" class="float-left mt-1">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">
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
                {{ $discounts->links() }}
              </div>
            </div>
          </div>
        @else
          <p>Geen aanbiedingen</p>
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