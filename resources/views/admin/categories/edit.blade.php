@extends('admin.layouts.layout')

@section('admincontent')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Сategorie bewerken</h4>
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
            <form role="form" method="post" action="{{ route('admin.categories.update', $category->slug) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Categorie "{{ $category->name }}"</label>
                  <input type="text" name="name" class="form-control @error('name') is-invalid" @enderror id="name" value="{{ $category->name }}">
                </div>
                <div class="form-group">
                  <label for="image">Categorie image</label>
                  <input type="file" id="image" name="image" accept="image/png, image/jpeg">
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              <!-- /.card-body -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection