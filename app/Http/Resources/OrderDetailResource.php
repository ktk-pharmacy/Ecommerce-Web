<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            "order_id" => $this->id,
            "delivery_charges" => $this->delivery_charge,
            "order_total" => $this->order_total,
            "order_note" => $this->order_note,
            "cancel_remark" => $this->cancel_remark,
            "payment_method" => $this->payment_method,
            "created_at" => $this->created_at,
            "status" => $this->status,
            "customer" => $this->customer,
            "order_products" => OrderProductCollection::collection($this->orderProducts)
        ];
    }
}
