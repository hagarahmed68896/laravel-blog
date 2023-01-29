<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
private $allPosts;
public function __construct()
{

    $this->allPosts = [
        [
            'id' => 1,
            'title' => 'laravel',
            'description' => 'hello this is laravel post',
            'posted_by' => 'Ahmed',
        ],
        [
            'id' => 2,
            'title' => 'html',
            'description' => 'hello this is html post',
            'posted_by' => 'Hagar',
        ],
        [
            'id' => 3,
            'title' => 'php',
            'description' => 'hello this is php post',
            'posted_by' => 'Mohamed',
        ],
    ];

}
    public function index()
    {
        return view('posts.index',['posts' =>$this->allPosts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function show($id)
    {  
        $post = array_filter($this->allPosts,function ($post) use ($id) {
            return $post['id'] == $id;
        });
        $post = array_pop($post);
        return view("posts.show", ['post' => $post]);
    }

    public function edit($id)
    {
        $post = array_filter($this->allPosts,function ($post) use ($id) {
            return $post['id'] == $id;
        });
        $post = array_pop($post);
        return view("posts.edit", ['post' => $post]);
    }
    public function store()
    {
        return view('posts.index',['posts' =>$this->allPosts]);
    }
}