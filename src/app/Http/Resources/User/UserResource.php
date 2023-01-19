<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public $preserveKeys = true;

    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            $this->mergeWhen(
                $this->name,
                ['name'=>$this->name],
            ),
        ];
    }
}
