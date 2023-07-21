@extends('admin.layouts.master')

@section('content')

<div class="container">
    <div class="bg-white text-dark">
        <h3>Contact Table</h3>
    </div>
    <div class="m-2 p-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Title</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                @foreach ($contacts as $item)
                <tr>
                    <th scope="row">{{$contacts->perPage()*($contacts->currentPage()-1)+$count}}</th>
                    <td>{{ $item->name }}</td>
                    <td><span class="">{{ $item->email }}</span></td>
                    <td>{{ Str::words($item->title, 3, '...') }}</td>
                    <td>
                        <a href="{{ route('contact#detail',$item->id) }}"><button class="btn btn-primary">Read</button></a>
                        <a href="{{ route('contact#delete',$item->id) }}"><button class=" ml-2 btn btn-sm btn-danger">Delete</button></a>
                    </td>
                </tr>
                <?php $count++; ?>
                @endforeach
            </tbody>
        </table>
        @if($contacts->total() === 0)
        <h1 class="mx-4 my-3">No Message...</h1>
        @endif
        <hr>
        <div class="mt-2 mr-5">
            {{ $contacts->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
