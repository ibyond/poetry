<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\UserCollection;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * test
     * @return string
     */
    public function test()
    {
        return 'test';
    }

    /**
     * 用户详情
     * @param Request $request
     * @return mixed
     */
    public function me(Request $request)
    {
        $user = $request->user();
        return $this->success(new UserResource($user));
    }


}
