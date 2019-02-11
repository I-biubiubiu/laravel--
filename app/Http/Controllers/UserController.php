<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // 个人设置页面
    public function setting() {
        $user = \Auth::user();
        return view('user.setting', compact('user'));
    }

    // 个人设置行为
    public function settingStore() {
        
    }
}
