<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;

class PostController extends Controller
{
    // 文章列表页面
    public function index() {
        $posts = Post::orderBy("created_at", "desc")->paginate(6);
        return view("post/index", compact('posts'));
    }

    // 文章详情页面
    public function show(Post $post) {
        return view("post/show", compact('post'));
    }

    // 文章创建页面
    public function create() {
        return view("post/create");
    }

    // 文章创建逻辑
    public function store() {
        $posts = Post::create(request(['title', 'content']));
        return redirect("/posts");
    }

    // 文章编辑页面
    public function edit() {
        return view("post/edit");
    }

    // 文章编辑逻辑
    public function update() {

    }

    // 文章删除逻辑
    public function delete() {

    }
}
