<?php

namespace App\Admin\Controllers;


class NoticeController extends Controller
{
    // 通知列表
    public function index() {
        $notices = \App\Notice::all();
        return view('admin/notice/index', compact('notices'));
    }

    // 添加通知
    public function create() {
        return view('admin/notice/create');
    }

    // 执行添加
    public function store() {
        $this->validate(request(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $notice = \App\Notice::create(request(['title', 'content']));

        dispatch(new \App\Jobs\SendMessage($notice));

        return redirect("/admin/notices");
    }
}