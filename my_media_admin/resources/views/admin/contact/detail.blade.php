@extends('admin.layouts.master')

@section('content')

<div class="container">
    <div class="mx-5 my-3 ">
        <a href="{{ route('admin#contact') }}">
            <div class="float-start"><i class="fa-solid fa-arrow-left-long fs-4 text-dark me-2"></i></div>
        </a>
    </div>
    <div class="card mx-5 p-5">
        <div class="card-title d-flex justify-content-between">
            <h3 class="text-center title-2 fs-4"><i class="fa-regular fa-user"></i> <span class="text-dark">{{ $contact->name }}  </span></h3>
            <div class="email"><i class="fa-regular fa-envelope-open me-2"></i> {{ $contact->email }}</div>
            <div><i class="fa-solid fa-calendar-check text-primary opacity-75"></i>  <p class="d-inline ">{{ $contact->created_at->format('j-F-Y') }}</p></div>
        </div>
        <hr>
        <div class="card-body ">
            <div class="row ">
                <div class="col-2 ">
                    <i class="fa-solid fa-file-pen ms-3 text-danger opacity-75"></i><span class="d-inline">Message  -</span>
                </div>
                <div class="col-9 ">
                    <p class="block-email">
                        {{ $contact->message }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
