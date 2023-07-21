@extends('admin.layouts.master')

@section('content')
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Post@update',$post->post_id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="form-group row d-flex align-items-center">
                          <label for="postTitle" >Title</label>
                            <input type="text" name="postTitle" value="{{ old('postTitle',$post->title) }}"  class="form-control @error('postTitle') is-invalid @enderror" id="postTitle" placeholder="Enter post name...">
                            @error('postTitle')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group row d-flex align-items-center">
                            <label for="postDescription" >Description</label>
                            <textarea name="postDescription" id="postDescription" placeholder="Enter description.." cols="30" rows="3" class="form-control @error('postDescription') is-invalid @enderror">{{ old('postDescription',$post->description) }}</textarea>
                            @error('postDescription')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                        </div>

                        <div class="form-group row d-flex align-items-center">
                            <label for="categoryId" >Category Name</label>
                            <select name="categoryId" id="categoryId" class="form-control">
                                <option value="">Choose category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->category_id }}" {{ $post->category_id  == $item->category_id ? 'selected' : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('categoryId')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group row d-flex align-items-center">
                            <label for="postImage" >Image</label>
                            <img  class="w-100 rounded shadow-sm"
                            @if ($post->image == null)
                            src="{{ asset('default/default.png') }}"
                            @else
                            src="{{ asset('images/'.$post->image) }}"
                            @endif/>
                            <input type="file" name="postImage" id="postImage" class="form-control">
                            @error('postImage')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group  mt-2">
                            <button type="submit" class="btn bg-primary btn-sm text-white" >Update</button>
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
                  <h3 class="card-title">Post List Table</h3>
                  <div class="card-tools">
                    <form action="{{ route('Post@searchList') }}" method="get">
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
                        <th>Title</th>
                        <th>Image</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $count = 1; ?>
                    @foreach ($posts as $item)
                    <tr>
                        <td>{{$posts->perPage()*($posts->currentPage()-1)+$count}}</td>
                        <td>{{ $item->title }}</td>
                        <td class="col-3">
                            <img  class="w-100 rounded shadow-sm"
                            @if ($item->image == null)
                            src="{{ asset('default/default.png') }}"
                            @else
                            src="{{ asset('images/'.$item->image) }}"
                            @endif/>
                        </td>
                        <td>
                            <a href="{{ route('post#editPage',$item->post_id) }}">
                                <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                            </a>
                            <a href="{{ route('Post@delete',$item->post_id) }}">
                                <button id="deleteBtn" class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                            </a>
                        </td>
                    </tr>
                    <?php $count++; ?>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="mt-2">{{ $posts->links() }}</div>
            </div>
        </div>

@endsection
