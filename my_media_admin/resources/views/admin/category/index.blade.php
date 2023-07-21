@extends('admin.layouts.master')

@section('content')
<div class="col-4">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('Catogory@create') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="categoryName">Category Name</label>
                    <input type="text" name="categoryName" value="{{ old('categoryName') }}@if(session('categoryName')) {{ session('categoryName') }} @endif" class="form-control @error('categoryName') is-invalid @enderror" id="categoryName" placeholder="Enter category name...">
                    @error('categoryName')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group row d-flex align-items-center">
                    <label for="categoryDescription">Description</label>
                    <textarea name="categoryDescription" id="categoryDescription" placeholder="Enter description.." cols="30" rows="5" class="form-control @error('categoryDescription') is-invalid @enderror">@if(session('categoryDescription')) {{ session('categoryDescription') }} @endif{{ old('categoryDescription') }}</textarea>
                    @error('categoryDescription')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group  mt-2">
                    <button type="submit" class="btn bg-success btn-sm text-white">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- List Table --}}
<div class=" col-8 ">
    {{-- alert-start --}}

    <div class="col-7 offset-5">
        @if (session('deleteSuccess'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('name') }}{{ session('deleteSuccess') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
    {{-- alert-end --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Catogory List Table</h3>

            <div class="card-tools">
                <form action="{{ route('Category@serchList') }}" method="get">
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
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php $count = 1; ?>
                    @foreach ($categories as $item)
                    <tr>
                        <td>{{$categories->perPage()*($categories->currentPage()-1)+$count}}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ Str::words($item->description, 3, '...') }}</td>
                        <td>
                            <a href="{{ route('category#editPage',$item->category_id) }}">
                                <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                            </a>
                            <a href="{{ route('Category@delete',$item->category_id) }}">
                                <button id="deleteBtn" class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                            </a>
                        </td>
                    </tr>
                    <?php $count++; ?>
                    @endforeach

                </tbody>
            </table>
            @if($categories->total() === 0)
            <h1 class="mx-4 my-3">No Category...</h1>
            @endif
        </div>
        <div class="mt-2">{{ $categories->appends(request()->query())->links() }}</div>
    </div>
</div>

@endsection
