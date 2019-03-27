<?php

namespace App\Http\Resources\Lists\Role;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginatorRoleResource extends JsonResource
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
            'data' => RoleResource::collection($this),
            'perPage' => $this->perPage(),
            'currentPage' => $this->currentPage(),
            'prevPageUrl' => $this->previousPageUrl(),
            'nextPageUrl' => $this->nextPageUrl(),
            'count' => $this->count(),
            'total' => $this->total()
        ];
    }
}
