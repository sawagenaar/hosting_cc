@extends('admin.layouts.layout')

@section('admincontent')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Nieuwsbericht aanmaken</h4>
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
            <form role="form" method="post" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Nieuwsbericht naam</label>
                  <input type="text" name="title" class="form-control @error('title') is-invalid" @enderror id="title" placeholder="Nieuwsbericht name">
                </div>
                <div class="form-group">
                  <label for="image">Nieuwsbericht photo</label>
                  <input type="file" name="image" class="form-control-file" accept="image/png, image/jpeg" id="image">
                </div>
                <div class="form-group">
                  <label for="shortdescription">Korte beschrijving</label>
                  <textarea type="text" name="shortdescription" class="form-control @error('shortdescription') is-invalid" @enderror id="shortdescription" placeholder="Korte beschrijving"></textarea>
                </div>
                <div class="form-group">
                  <label for="fulldescription">Volledige beschrijving</label>
                  <textarea type="text" rows="6" name="fulldescription" class="form-control @error('fulldescription') is-invalid" @enderror id="fulldescription" placeholder="Volledige beschrijving"></textarea>
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