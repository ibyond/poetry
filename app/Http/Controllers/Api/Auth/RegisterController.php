<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(RegisterRequest $request)
    {
        User::create($request->all());
        return '用户注册成功。。。';
    }

}
