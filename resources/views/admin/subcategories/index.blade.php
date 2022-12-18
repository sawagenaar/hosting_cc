@extends('admin.layouts.layout')

@section('admincontent')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Subcategorie lijst</h4>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-body">
        <a href="{{ route('admin.subcategories.create') }}" class="btn btn-primary mb-3">Add subcategory</a>
        @if (count($subcategories))
          <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
              <thead>
                <tr class="text-xs">
                  <th style="width: 30px">#</th>
                  <th>Subcategorie name</th>
                  <th>Slug</th>
                  <th>Categorie slug</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($subcategories as $subcategory)
                <tr class="text-sm">
                  <td>{{ $subcategory->id }}</td>
                  <td>{{ $subcategory->name }}</td>
                  <td>{{ $subcategory->slug }}</td>
                  <td>{{ $subcategory->category_slug }}</td>
                  <td>
                    <a href="{{ route('admin.subcategories.edit', $subcategory->slug) }}" class="btn btn-info btn-sm float-left mr-1">
                      <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('admin.subcategories.destroy', $subcategory->slug) }}" method="post" class="float-left">
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
                {{ $subcategories->links() }}
              </div>
            </div>
          </div>
        @else
          <p>Geen subcategorieën</p>
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