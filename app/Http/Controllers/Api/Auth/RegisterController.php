<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\RegisterRequest;
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
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return $this->success('注册成功');
    }

}
