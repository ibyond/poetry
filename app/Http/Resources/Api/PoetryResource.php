<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PoetryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'dynasty_name' => $this->dynasty_name,
            'dynasty_id' => $this->dynasty_id,
            'content' => $this->content,
            'author' => $this->author,
            'poet_id' => $this->poet_id,
            'poet' => new PoetResource($this->whenLoaded('poet')),
            'star' => $this->star,
            'fanyi' => $this->fanyi,
            'shangxi' => $this->shangxi,
            'about' => $this->about,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
