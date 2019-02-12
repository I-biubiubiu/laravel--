<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use \App\Comment;

class PostController extends Controller
{
    // 文章列表页面
    public function index() {
        $posts = Post::orderBy("created_at", "desc")->withCount("comments")->paginate(6);
        return view("post/index", compact('posts'));
    }

    // 文章详情页面
    public function show(Post $post) {
        $post->load('comments');
        return view("post/show", compact('post'));
    }

    // 文章创建页面
    public function create() {
        return view("post/create");
    }

    // 文章创建逻辑
    public function store() {
        // 验证
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);
        $user_id = \Auth::id();
        $params = array_merge(request(['title', 'content']), compact('user_id'));
        $posts = Post::create($params);
        return redirect("/posts");
    }

    // 文章编辑页面
    public function edit(Post $post) {
        return view("post/edit", compact('post'));
    }

    // 文章编辑逻辑
    public function update(Post $post) {
        // 验证
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);
        $this->authorize('update', $post);
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        return redirect("/posts/{$post->id}");
    }

    // 文章删除逻辑
    public function delete(Post $post) {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect("/posts");
    }

    // 上传图片
    public function imageUpload(Request $request) {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'. $path);
    }

    // 提交评论
    public function comment(Post $post, Comment $comment) {
        $this->validate(request(), [
            'content' => 'required|min:3',
        ]);
        
        $comment->user_id = \Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);

        return back();
    }
}
