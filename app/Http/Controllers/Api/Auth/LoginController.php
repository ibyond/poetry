<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Jobs\Api\SaveLastTokenJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function login(LoginRequest $request)
    {
        //获取当前守护的名称
        $present_guard = Auth::getDefaultDriver();
        $token = Auth::claims(['guard' => $present_guard])->attempt(['name' => $request->name, 'password' => $request->password]);
//        if($token) {
//            return $this->setStatusCode(201)->success(['token' => $token]);
//        }
        if ($token) {
            //如果登陆，先检查原先是否有存token，有的话先失效，然后再存入最新的token
            $user = Auth::user();
            if ($user->last_token) {
                try {
                    Auth::setToken($user->last_token)->invalidate();
                } catch (TokenExpiredException $e) {
                    //因为让一个过期的token再失效，会抛出异常，所以我们捕捉异常，不需要做任何处理
                }
            }
//            $user->last_token = $token;
//            $user->save();
            SaveLastTokenJob::dispatch($user, $token);
            return $this->setStatusCode(201)->success(['token' => $token]);
        }
        return $this->failed('账号或密码错误', 400);
    }


}
