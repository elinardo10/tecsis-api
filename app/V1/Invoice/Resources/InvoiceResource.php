<?php

namespace App\V1\Invoice\Resources;

use App\V1\Customer\Resources\CustomerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'       => (integer) $this->id,
            'total'    => (float) $this->total,
            'due_date' => (string) $this->first_due_date ? $this->first_due_date->toISOString() : '',
            'customer' => new CustomerResource($this->whenLoaded('customer')),
        ];
    }
}
