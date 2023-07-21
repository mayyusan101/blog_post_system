@extends('admin.layouts.master')

@section('content')

<div class="col-12">
    <div class="offset-7 col-5">
          {{-- alert-start --}}
          @if (session('deleteMessage'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Admin {{ session('name') }} {{ session('deleteMessage') }}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
          @endif
          {{-- alert-end --}}
    </div>
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Admin List Table</h3>

          <div class="card-tools">
            <form action="{{ route('Admin@serchList') }}" method="get">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="searchKey" value="{{ request('searchKey') }}" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                    </div>
                </div>
            </form>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap text-center">
            <thead>
              <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Gender</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
               <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->gender }}</td>
                <td>
                  {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}
                   @if (auth()->user()->id != $user->id)
                    <a href="{{ route('Admin@delete',$user->id) }}">
                      <button id="deleteBtn" class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                    </a>
                   @endif
                </td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
@endsection

