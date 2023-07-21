@extends('admin.layouts.master')

@section('content')
<div class="col-8 offset-2 my-4">
    <i class="fa-solid fa-arrow-left text-dark fs-2 mb-1" style="cursor: pointer;" onclick="history.back()"></i>
    <div class="card">
        <div class="card-header">
            <div class="row mb-4 col-6 offset-3 shadow-sm">
                <img src="@if ($post->image == null)
                {{ asset('default/default.png') }}
                @else
                    {{ asset('images/'.$post->image) }}
                @endif" alt="" style="width:100%;">
            </div>
            <h3 class="text-center">
                Title - {{ $post->title }}
            </h3>
        </div>
        <div class="card-body text-start">
            Description - {{ $post->description }}
        </div>
    </div>
</div>
@endsection
