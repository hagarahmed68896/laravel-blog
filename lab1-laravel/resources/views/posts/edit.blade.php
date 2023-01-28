@extends('layouts.app')
@section('title') {{ $post['title'] }} @endsection
@section('content')
 <form method="POST" action="{{ route('posts.index') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" value="{{ $post['title'] }}">
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea
                class="form-control"
            >{{ $post['description'] }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-check-label">Post Creator</label>

            <select class="form-control">
                <option>{{ $post['posted_by'] }}</option>
                <option>Ahmed</option>
                <option>Hagar</option>
                <option>Mohamed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection