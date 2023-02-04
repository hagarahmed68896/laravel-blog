<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CommentController;
use App\Jobs\runeOldPostsJob;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePostRequest;


class PostController extends Controller
{

    public function index()
    {

        $allPosts = Post::paginate(6);
        return view('posts.index',[
            'posts' => $allPosts,
        ]);
    }


    public function create()
    {
        $users = User::get();

        return view('posts.create',[
            'users' => $users,
        ]);
    }


    public function store(StorePostRequest $request)
    {

        // upload image to storage
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

        return to_route('posts.index');
    }


    public function show($postId)
    {
        $post = Post::find($postId);
        return view('posts.show',['post' => $post]);
    }


    public function edit($postId)
    {
       $post = Post::find($postId);
        return view("posts.edit", ['post' => $post]);
    }


    public function update($postId, Request $request)
    {
        $newPost = $request->all();

        // add validation rules 
        $request->validate([
            'title'=>['required','min:3','unique:posts,title,'. $postId],
            'description'=>['required','min:10'],
            'user_id'=>[Rule::in('post_creator','user_id')],
        ]);
        $post = Post::find($postId);
         // upload image to storage
        if ($post->exists('image')) {      
            $path = Storage::putFile('public', $request->file('image'));
            if ($post->image) {
                // delete old image
                Storage::delete($post->image);
            }
        } else {
            $path = null;
        }
     
        $post->update([ 
        'title' => $newPost['title'],
        'description' => $newPost['description'],
        'user_id' => $newPost['post_creator'],
        'image' => $path,
    ]);
            $post->save();
       
            return redirect()->route('posts.index');
        }
    

    public function destroy($postId)
    {
    // {  dd($postId);
        Post::find($postId)->delete();
        return back();
    }
 
// to redirect the deleted post to restore page
     public function restore()
     { 
        $allPosts = Post::onlyTrashed()->get();
         return view('posts.restore', ['posts' => $allPosts,]);
     }
   
// to restore the deleted post to index page after trash
     public function reback($postId)
     {
        Post::whereId($postId)->restore();
        return back();
     }

}