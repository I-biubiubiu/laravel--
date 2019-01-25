<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // 文章列表页面
    public function index() {
        return view("post/index");
    }

    // 文章详情页面
    public function show() {
        return view("post/show");
    }

    // 文章创建页面
    public function create() {
        return view("post/create");
    }

    // 文章创建逻辑
    public function store() {

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
