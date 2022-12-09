<?php

namespace App\V1\Role\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'id'      => (integer)$this->id,
            'name'    => (string)$this->name,
            'label'   => (string)$this->label,
            'user_id' => $this->whenPivotLoaded('role_user', function () {
                return $this->pivot->user_id;
            }),
        ];
    }
}
