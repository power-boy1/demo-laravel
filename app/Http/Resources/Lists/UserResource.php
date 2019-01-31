<?php

namespace App\Http\Resources\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'linkDetails' => route('get.manage.user.details', ['id' => $this->id]),
            'linkEdit' => route('get.manage.user.edit', ['id' => $this->id]),
            'linkDelete' => route('delete.manage.user.delete', ['id' => $this->id])
        ];
    }
}
