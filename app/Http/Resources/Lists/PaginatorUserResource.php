<?php

namespace App\Http\Resources\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginatorUserResource extends JsonResource
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
            'data' => UserResource::collection($this),
            'perPage' => $this->perPage(),
            'currentPage' => $this->currentPage(),
            'prevPageUrl' => $this->previousPageUrl(),
            'nextPageUrl' => $this->nextPageUrl(),
            'count' => $this->count(),
            'total' => $this->total()
        ];
    }
}
