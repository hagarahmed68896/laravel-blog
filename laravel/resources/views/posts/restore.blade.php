@extends('layouts.app')
@section('title')
    Restore
@endsection
@section('content')
    <div class="row d-flex">
        <div class="col-lg-12 col-md-9 col-sm-6">
            <div class="container">
                <div style="text-align: center"><h2>Trashed Posts</h2></div>  
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Posted By</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Deleted At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user ? $post->user->name : 'Not Found' }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                                <td>{{ $post->deleted_at }}</td>
                                <td>
                                    <a href="{{ route('posts.reback', $post->id) }}" class="btn btn-success">
                                        Restore</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
