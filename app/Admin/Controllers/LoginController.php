<?php

namespace App\Admin\Controllers;

class LoginController extends Controller
{
    // 登陆展示页
    public function index() {
        return view('admin/login/index');
    }

    // 登陆操作
    public function login() {
        $this->validate(request(), [
            'name' => 'required|min:2',
            'password' => 'required|min:5|max:10',
        ]);

        $user = request(['name', 'password']);
        if (\Auth::guard("admin")->attempt($user)) {
            return redirect('/admin/home');
        }

        return \Redirect::back()->withErrors('用户名密码不匹配');
    }

    public function logout() {

    }
}