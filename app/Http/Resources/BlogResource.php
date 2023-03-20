<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'feature_image' => $this->feature_image,
            'name' => $this->name,
            'description' => $this->description,
            'author' => $this->author?->name,
            'updated_at' => $this->updated_at->diffForHumans(),
            'categories' => BlogCategoryCollection::collection($this->terms),
        ];
    }
}
