<?php

namespace App\V1\Customer\Resources;


use App\V1\Invoice\Resources\InvoiceResource;
use App\V1\Product\Resources\ProductResource;
use App\V1\Role\Resources\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */

    public function toArray($request)
    {
        return [
            'id'       => (integer) $this->id,
            'name'     => (string) $this->name,
            'email'    => (string) $this->email,
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'invoices' => InvoiceResource::collection($this->whenLoaded('invoices')),
            'roles'    => RoleResource::collection($this->whenLoaded('roles')),
        ];
    }
}
