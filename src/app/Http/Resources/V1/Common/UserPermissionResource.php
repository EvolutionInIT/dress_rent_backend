<?php

namespace App\Http\Resources\V1\Common;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPermissionResource extends JsonResource
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
            'permission_id' => $this->permission_id,
            'permission' => $this->permission,
        ];
    }
}
