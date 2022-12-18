@extends('admin.layouts.layout')

@section('admincontent')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Aanbieding aanmaken</h4>
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
            <form role="form" method="post" action="{{ route('admin.discounts.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="title">Aanbieding naam</label>
                  <input type="text" name="title" class="form-control @error('title') is-invalid" @enderror id="title" placeholder="aanbieding naam">
                </div>
                <div class="form-group">
                  <label for="image">Aanbieding photo</label>
                  <input type="file" name="image" class="form-control-file" accept="image/png, image/jpeg, image/jpg" id="image">
                </div>
                <div class="form-group">
                  <label for="shortdescription">Korte beschrijving</label>
                  <input type="text" name="shortdescription" class="form-control @error('shortdescription') is-invalid" @enderror id="shortdescription" placeholder="Korte beschrijving">
                </div>
                <div class="form-group">
                  <label for="fulldescription">Volledige beschrijving</label>
                  <textarea name="fulldescription"
                  class="form-control @error('fulldescription') is-invalid" @enderror
                  id="fulldescription" rows="5" placeholder="volledige beschrijving"></textarea>
                </div>
                <div class="form-group">
                  <label for="startTime">Start datum</label>
                  <input type="date" name="startTime" class="form-control-file">
                </div>
                <div class="form-group">
                  <label for="endTime">End datum</label>
                  <input type="date" name="endTime" class="form-control-file">
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