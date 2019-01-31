<?php

namespace App\Http\Resources\Messages;

use App\Utils\FlashMessage;
use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResource extends JsonResource
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
            'type' => FlashMessage::TYPE_SUCCESS,
            'title' => FlashMessage::OK,
            'text' => $this['text']
        ];
    }
}
