@extends('admin.layouts.master')

@section('content')

<div class="col-9 offset-2 mt-2">
    <div class="col-md-11">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Change Password</legend>
        </div>
        <div class="card-body">
            <div class="col-9 offset-3">
            {{-- alert-start --}}
            @if (session('failMessage'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ session('failMessage') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            {{-- alert-end --}}
            </div>

          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form action="{{ route('Admin@changePassword') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="form-group row d-flex align-items-center">
                  <label for="oldPassword" class="col-sm-3 col-form-label">Old password</label>
                  <div class="col-sm-7">
                    <input type="password" name="oldPassword"  class="form-control @error('oldPassword') is-invalid @enderror" id="oldPassword" placeholder="Enter your oldPassword...">
                    @error('oldPassword')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>

                <div class="form-group row d-flex align-items-center">
                    <label for="newPassword" class="col-sm-3 col-form-label">New password</label>
                    <div class="col-sm-7">
                      <input type="password" name="newPassword"  class="form-control @error('newPassword') is-invalid @enderror" id="newPassword" placeholder="Enter your newPassword...">
                      @error('newPassword')
                          <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                </div>

                  <div class="form-group row d-flex align-items-center">
                    <label for="comfirmPassword" class="col-sm-3 col-form-label">Confirm password</label>
                    <div class="col-sm-7">
                      <input type="password" name="comfirmPassword"  class="form-control @error('comfirmPassword') is-invalid @enderror" id="comfirmPassword" placeholder="Enter your comfirmPassword...">
                      @error('comfirmPassword')
                          <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                </div>

                <div class="form-group  d-flex justify-content-around mt-2">
                  <div class=" ">
                    <button type="submit" class="btn bg-primary btn-sm text-white">Update</button>
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
