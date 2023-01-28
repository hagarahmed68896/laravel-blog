@extends('layouts.app')
@section('title') {{ $post['title'] }} @endsection
@section('content')
    <div style=" border:3px solid black; padding:5px;margin-top:10%; width:500px;margin-left:25%">
        <h1  style="margin-left:26%;">Information</h1><br>
        <span style="font-weight: bold">Title:</span> {{ $post['title'] }} <br><br>
        <span style="font-weight: bold">Description:</span> {{ $post['description'] }} <br><br>
        <span style="font-weight: bold">Posted_by:</span> {{ $post['posted_by'] }}
    </div>
@endsection