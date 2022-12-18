@extends('admin.layouts.layout')

@section('admincontent')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Product aanmaken</h4>
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
            <form role="form" method="post" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="card-body row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Product naam</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid" @enderror id="name" placeholder="name">
                  </div>
                  <div class="form-group">
                    <label for="shortdescription">Korte beschrijving</label>
                    <input type="text" name="shortdescription" class="form-control @error('shortdescription') is-invalid" @enderror id="shortdescription" placeholder="korte beschrijving">
                  </div>
                  <div class="form-group">
                    <label for="fulldescription">Volledige beschrijving</label>
                    <textarea name="fulldescription"
                    class="form-control @error('fulldescription') is-invalid" @enderror
                    id="fulldescription" rows="5" placeholder="Volledige beschrijving"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="text" name="discount" class="form-control @error('discount') is-invalid" @enderror id="discount" placeholder="discount">
                  </div>
                  <div class="form-group">
                    <label for="price">Prijs</label>
                    <input type="text" name="price" class="form-control @error('price') is-invalid" @enderror id="price" placeholder="price">
                  </div>
                  <div class="form-group">
                    <label for="weight">Gewicht</label>
                    <input type="text" name="weight" class="form-control @error('weight') is-invalid" @enderror id="weight" placeholder="weight">
                  </div>
                  <div class="form-group">
                    <label for="sub_category_slug">Subcategory slug </label>
                    <input type="text" name="sub_category_slug" class="form-control @error('sub_category_slug') is-invalid" @enderror id="sub_category_slug" placeholder="sub_category_slug">
                  </div>
                  <div class="form-group">
                    <label for="image">Product image</label>
                    <input type="file" id="image" name="image" accept="image/png, image/jpeg">
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