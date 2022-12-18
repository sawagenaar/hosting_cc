@extends('admin.layouts.layout')

@section('admincontent')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Nieuwsberichten</h4>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-body">
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary mb-3">Add nieuwsbericht</a>
        @if (count($news))
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr class="text-xs">
                  <th style="width: 30px">#</th>
                  <th>Title</th>
                  <th>Image</th>
                  <th>Korte beschrijving</th>
                  <th>Volledige beschrijving</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($news as $item)
                <tr class="text-sm">
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->title }}</td>
                  <td>
                    <img src="{{ asset('storage/'.$item->image) }}" width="100px">
                  </td>
                  <td>{{ $item->shortdescription }}</td>
                  <td>{{ $item->fulldescription }}</td>
                  <td>
                    <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-info btn-sm float-left mr-1">
                      <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('admin.news.destroy', $item->id) }}" method="post" class="float-left mt-1">
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
                {{ $news->links() }}
              </div>
            </div>
          </div>
        @else
          <p>Geen news</p>
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