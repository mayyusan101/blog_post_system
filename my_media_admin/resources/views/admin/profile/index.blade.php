@extends('admin.layouts.master')

@section('content')

<div class="col-10 offset-2 mt-2">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Admin Profile</legend>
        </div>
        <div class="card-body">
            {{-- alert-start --}}
            @if (session('updateSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('updateSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            {{-- alert-end --}}
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form action="{{ route('Admin@accoutUpdate') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" value="{{ old('name',$user->name) }}" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Enter your name...">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" value="{{ old('email',$user->email) }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter your email...">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" id="phone" placeholder="Enter your phone number...">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <textarea name="address" id="address" cols="30" rows="4" placeholder="Enter you address.." class="form-control">{{ $user->address }}</textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                      <select name="gender" id="gender" class="form-control">
                        <option value="empty">Choose you option</option>
                        <option value="male" @if ($user->gender==='male')  selected  @endif>Male</option>
                        <option value="female"  @if ($user->gender==='female')  selected  @endif>Female</option>
                      </select>
                    </div>
                  </div>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark btn-sm mb-2 text-white">Update</button>
                  </div>
                  <div class="text-end">
                    <a href="{{ route('admin#passwordPage') }}" class="mt-3">Change your password</a>
                  </div>
                </div>
              </form>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection
