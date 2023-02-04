<?php

namespace App\Http\Controllers\Api;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index(){
        $posts= Post::all();
        return PostResource::collection($posts);
    }

    public function show($postId){
        $post = Post::find($postId);
        return new PostResource($post);
    }

    public function store(StorePostRequest $request){
        if ($request->exists('image')) {   
            $path = Storage::putFile('public', $request->file('image'));
        } else {
            $path = null;
        }
        $data = $request->all();
        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
            'image' => $path
        ]);

        return $data;
    }
}
