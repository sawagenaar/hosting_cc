@extends('superadmin.layout')

@section('admincontent')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Super Adminpanel</h4>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-body">
        @if (count($users))
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr class="text-xs">
                <th style="width: 30px">#</th>
                <th>User name</th>
                <th>Email</th>
                <th>user_type</th>
                <th style="width: 100px">Actions</th>
              </tr>
            </thead>
            <tbody class="text-xs">
              @foreach ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email}}</td>
                <td>{{ $user->user_type }}</td>
                <td>
                  <a href="{{ route('superadmin.admin.edit', $user->id) }}" class="btn btn-info btn-sm float-left mr-1 mt-1">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  <form action="{{ route('superadmin.admin.destroy', $user->id) }}" method="post" class="float-left mt-1">
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
      @else
        <p>Geen users</p>
      @endif
      </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->

@endsection