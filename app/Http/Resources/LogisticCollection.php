<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogisticCollection extends JsonResource
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
            'id' => $this->id,
            'type' => $this->type,
            'city' => $this->city?->name,
            'township' => $this->township?->name,
            'area_description' => $this->area_description,
            'min_order_total' => $this->min_order_total,
            'delivery_charges' => DeliveryChargesCollection::collection($this->deliveryFees),
        ];
    }
}
