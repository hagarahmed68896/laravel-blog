@extends('layouts.app')

@section('title')
    create
@endsection

@section('content')

   <div class="container">
    <div class="row">
            {{-- add validation messages --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div style="text-align: center">
            <h1>Add New Post</h1>
        </div>     
    <form method="POST" action="/posts" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-check-label">Post Creator</label>
            <select name="post_creator" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <label class="form-check-label">Post Image</label>
        <input class="form-control" type="file" id="formFile" name="image" accept="image/png, image/jpeg, image/jpg"> <br>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
</div>
@endsection
