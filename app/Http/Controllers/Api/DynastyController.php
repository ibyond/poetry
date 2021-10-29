<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\DynastyResource;
use App\Models\Dynasty;
use Illuminate\Http\Request;

class DynastyController extends Controller
{

    /**
     * 朝代列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $dynasties = Dynasty::all();
        return $this->success(DynastyResource::collection($dynasties));
    }

}
