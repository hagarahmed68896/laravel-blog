<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;

class CommentController extends Controller
{

        public function store($id, Request $request)
        {
            $comment = $request->all();
            $post = Post::find($id);
            $post->comments()->create(
                [
                    'comment' => $comment['comment'],
                ]
            );
            return redirect()->route('posts.show', ['post' => $id]);
        }

        public function edit($id)
        {
            $comment = Comment::find($id);
            return view("comments.edit", ['comment' => $comment]);
        }
}
