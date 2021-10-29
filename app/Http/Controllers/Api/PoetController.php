<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\PoetResource;
use App\Models\Poet;
use Illuminate\Http\Request;

class PoetController extends Controller
{
    /**
     * 诗人列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $name = $request->name;
        $query = Poet::query()->select(['id', 'name', 'image', 'dynasty_name', 'star']);
        if ($name) {
            $query->where('name', 'like', $name . '%');
        }

        $poets = $query->orderBy('star', 'desc')->paginate(10);
        return $this->success($poets);
    }

    //诗人详情
    public function show(Poet $poet)
    {
        return $this->success(new PoetResource($poet));
    }

}
