<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\PoetryResource;
use App\Models\Poetry;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PoetryController extends Controller
{
    //诗词列表
    public function index(Request $request)
    {
        $query = Poetry::query();
        $name = $request->name;
        if ($name) {
            $query->where(function ($query) use ($name) {
                $query->where('name', 'like', $name . '%')
                    ->orWhere('poet_name', 'like', $name . '%')
                    ->orWhereHas('tags', function (Builder $query) use ($name) {
                        $query->where('name', 'like', $name . '%');
                    });
            });
        }
        $poetries = $query->where('status', Poetry::STATUS_NORMAL)
            ->orderBy('star', 'desc')
            ->select('id', 'name', 'dynasty_name', 'content', 'poet_name', 'star')
            ->paginate(10);
        return $this->success($poetries);
    }

    public function show(Request $request, $id)
    {
        $poetry = Poetry::query()->where('id', $id)->with(['tags'])->first();
        return $this->success(new PoetryResource($poetry));
    }

    //诗人的诗
    public function poetryList(Request $request, $id)
    {
        $poetry = Poetry::query()
            ->where('poetries.poet_id', $id)
            ->select(['id', 'name', 'dynasty_name', 'content', 'poet_id','poet_name', 'star'])
            ->orderBy('star', 'desc')
            ->paginate(10);
        return $this->success($poetry);
    }
}
