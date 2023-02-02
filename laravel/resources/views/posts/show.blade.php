@extends('layouts.app')
@section('title')
    Info
@endsection
@section('content')
    <div style="text-align: center">
        <h2>Post Information</h2>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-7 ">
                <span style="font-weight:bold;font-size:20px;margin-right:10px">{{ $post->title }}</span>
                <span style="color: gray;float:center"> {{ $post->created_at->format('jS \o\f F, Y g:i:s a') }}</span>
                <br>
                <div>
                    @if ($post->image)
                        <div class="mt-1">
                            <img src="{{Storage::url($post->image)}}" alt=""
                                style="width: 100%;
                          height: 200px; object-fit: cover; margin-bottom:10px; border-radius: 3px;">
                        </div>
                    @endif
                    <span style="color:gray">{{ $post->user->name ?? 'Not found' }} -
                        {{ $post->user->email ?? 'Not found' }}</span><br><br>
                    <span> {{ $post->description }}</span>

                </div>
            </div>


            {{--  Create a comment --}}
            <div class="col-sm-5">
                <h4>Comments</h4>
                @foreach ($post->comments as $comment)
                    <div class="ps-2" style="border: 1px solid gray; border-raduis:2px;width: 500px;">
                        <span style="font-size:20px;margin-right:10px">{{ $post->user->name }}</span>
                        <span style="color: gray">{{ $comment->created_at->format('20y/m/d') }}</span><br><br>
                        <h6>{{ $comment->comment }}</h6>
                    </div>
                @endforeach
                <form method="POST" action="{{ route('comments.store', $post->id) }}">
                    @csrf
                    <div class="mb-3 mt-2">
                        <h3>
                            <textarea class="form-control" placeholder="Add Your Comment" name="comment"
                                style="width: 500px;
                              height:80px;"></textarea>
                        </h3>
                    </div>
                    <button type="submit" class=" btn btn-outline-success">Post Your Comment</button>
                </form>

            </div>

        </div>
    </div>
@endsection
