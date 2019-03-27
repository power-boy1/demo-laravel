<?php

namespace App\Http\Resources\Lists\Role;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'description' => $this->description,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'linkDetails' => route('get.manage.role.details', ['id' => $this->id]),
            'linkEdit' => route('get.manage.role.edit', ['id' => $this->id]),
            'linkDelete' => route('delete.manage.role.delete', ['id' => $this->id])
        ];
    }
}
