<?php

namespace App\Http\Resources;

use App\Http\Resources\ProductGalleryCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "category_group_name" => $this->sub_category?->parent?->group?->name,
            "main_category_name" => $this->sub_category?->parent?->name,
            "sub_category_name" => $this->sub_category?->name,
            "brand_name" => $this->brand?->name,
            "sale_price" => $this->sale_price,
            "discount_price" => $this->discount,
            "stock" => $this->stock,
            "uom" => $this->uom,
            "net_weight" => (float)$this->net_weight,
            "gross_weight" => (float)$this->gross_weight,
            "sold_count" => $this->sold_count,
            "sell_limit" => $this->sell_limit,
            "is_new" => $this->is_new,
            "feature_image" => $this->feature_image,
            "galleries" => ProductGalleryCollection::collection($this->galleries),
            "detail" => $this->detail,
            "other_information" => $this->other_information
        ];
    }
}
