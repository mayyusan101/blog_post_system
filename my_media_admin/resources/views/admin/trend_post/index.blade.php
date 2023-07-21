@extends('admin.layouts.master')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Trend Post Table</h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Post Name</th>
                        <th>Image</th>
                        <th>View Count</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trendPosts as $item)
                    <tr>
                        <td>{{ $item->actionLog_id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            <img src="@if ($item->image == null)
                            {{ asset('default/default.png') }}
                        @else
                            {{ asset('images/'.$item->image) }}
                        @endif" alt="" style="width:100px;">
                        </td>
                        <td><i class="fa-solid fa-eye"></i> {{ $item->view }}</td>
                        <td>
                            <a href="{{ route('trendPost#detailPage',$item->post_id) }}" title="detail"><button class="btn dark"><i class="fa-solid fa-clipboard me-1"></i> View</button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($trendPosts->total() === 0)
            <h1 class="mx-4 my-3">No Trend Post...</h1>
            @endif
        </div>
        <!-- /.card-body -->
        <div class="mt-2"> {{ $trendPosts->links() }}</div>
    </div>
</div>
@endsection
