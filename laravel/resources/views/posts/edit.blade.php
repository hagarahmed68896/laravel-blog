@extends('layouts.app')
@section('title') {{$post->title}} @endsection
@section('content')
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
<div class="container">
    <div class="row">
        <div style="text-align: center">
            <h1>Edit Post</h1>
        </div> 
     <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label  class="form-label">Title</label>
            <input name="title" type="text" class="form-control" value="{{$post->title}}">
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea
            name="description"
                class="form-control"
            >{{$post->description}}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-check-label">Post Creator</label>

            <select name="post_creator" class="form-control">
                <option name="user" value= {{$post->user->id ?? 'Not found'}} selected>{{ $post->user->name ??'Not found'}}</option>
            </select>
        </div>
        <label class="form-check-label">Post Image</label>
        <input class="form-control" type="file" id="formFile" name="image" accept="image/png, image/jpeg, image/jpg">
        <br>
        <button type="submit" class="btn btn-success">Save</button>
    </form>           
</div>
</div>
@endsection