@extends('admin.layouts.layout')

@section('admincontent')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Nieuwsbericht bewerken</h4>
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
            <form role="form" method="post" action="{{ route('admin.news.update', $newsItem->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="title">Nieuwsbericht {{ $newsItem->title }}</label>
                  <input type="text" name="title" class="form-control @error('title') is-invalid" @enderror id="title" value="{{ $newsItem->title }}">
                </div>
                <div class="form-group">
                  <label for="image">Nieuwsbericht image</label>
                  <input type="file" id="image" name="image" accept="image/png, image/jpeg">
                </div>
                <div class="form-group">
                  <label for="shortdescription">Korte beschrijving</label>
                  <input type="text" name="shortdescription" class="form-control @error('shortdescription') is-invalid" @enderror id="shortdescription" value="{{ $newsItem->shortdescription }}">
                </div>
                <div class="form-group">
                  <label for="fulldescription">Volledige beschrijving</label>
                  <input type="text" name="fulldescription" class="form-control @error('fulldescription') is-invalid" @enderror id="fulldescription" value="{{ $newsItem->fulldescription }}">
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