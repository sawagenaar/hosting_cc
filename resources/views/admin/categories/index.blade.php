@extends('admin.layouts.layout')

@section('admincontent')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Categorie lijst</h4>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-body">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add category</a>
        @if (count($categories))
          <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
              <thead>
                <tr class="text-xs">
                  <th style="width: 30px">#</th>
                  <th>Categorie name</th>
                  <th>Slug</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $category)
                <tr class="text-sm">
                  <td>{{ $category->id }}</td>
                  <td>{{ $category->name }}</td>
                  <td>{{ $category->slug }}</td>
                  <td>
                    <img src="{{ asset('storage/'.$category->image) }}" width="100px">
                  </td>
                  <td>
                    <a href="{{ route('admin.categories.edit', $category->slug) }}" class="btn btn-info btn-sm float-left mr-1">
                      <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category->slug) }}" method="post" class="float-left">
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
                {{ $categories->links() }}
              </div>
            </div>
          </div>
        @else
          <p>Geen categorieën</p>
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