<?php

namespace App\Traits;

trait ResourcesListWith
{
    /**
     * 返回应该和资源一起返回的其他数据数组
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request): array
    {
        return [
            'code' => 200,
            'status' => 'success',
        ];
    }

}
