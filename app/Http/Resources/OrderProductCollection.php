<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "product_id" => $this->product_id,
            "name" => $this->product?->name,
            "feature_image" => $this->product?->feature_image,
            "sale_price" => $this->sale_price,
            "quantity" => $this->quantity,
            "discount_total" => $this->discount_total,
            "order_product_total" => $this->order_product_total,
        ];
    }
}
