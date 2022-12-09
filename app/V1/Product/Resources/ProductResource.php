<?php

namespace App\V1\Product\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => (integer) $this->id,
            'name'        => (string) $this->name,
            'amount'      => $this->amount,
            'qty'         => (integer) $this->qty,
            'description' => (string) $this->description,
        ];
    }
}
